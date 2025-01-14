/* global Stripe, wpforms, wpforms_stripe, WPForms */

/**
 * WPForms Stripe Payment Element function.
 *
 * @since 2.10.0
 */
'use strict';

var WPFormsStripePaymentElement = window.WPFormsStripePaymentElement || ( function( document, window, $ ) {

	/**
	 * Original Submit Handler.
	 *
	 * @since 2.10.0
	 *
	 * @type {Function}
	 */
	let originalSubmitHandler;

	/**
	 * Public functions and properties.
	 *
	 * @since 2.10.0
	 *
	 * @type {object}
	 */
	let app = {

		/**
		 * Stripe object.
		 *
		 * @since 2.10.0
		 *
		 * @type {object}
		 */
		stripe: null,

		/**
		 * Object to store form data.
		 *
		 * @since 2.11.0
		 *
		 * @type {object}
		 */
		forms: {},

		/**
		 * Start the engine.
		 *
		 * @since 2.10.0
		 */
		init: function() {

			app.stripe = Stripe( // eslint-disable-line new-cap
				wpforms_stripe.publishable_key,
				{
					'locale': wpforms_stripe.data.element_locale,
					'betas': [ 'elements_enable_deferred_intent_beta_1' ],
				}
			);

			app.initializeFormsDefaultObject();

			$( document ).on( 'wpformsReady', function() {

				$( '.wpforms-stripe form' ).each( app.setupStripeForm );

				// Initialize in Conversational Form on field activation.
				$( '.wpforms-field-stripe-credit-card' ).on( 'wpformsConvFormsFieldActivationAfter', app.convFormsFieldActivationAfter );
			} );

			$( document )
				.on( 'wpformsBeforePageChange', app.pageChange )
				.on( 'wpformsPageChange', app.pageChangeAfter )
				.on( 'wpformsAmountTotalCalculated', app.updateElementsTotalAmount )
				.on( 'wpformsProcessConditionalsField', function( e, formID, fieldID, pass, action ) {
					app.processConditionalsField( formID, fieldID, pass, action );
				} );
		},

		/**
		 * Initialize forms default object.
		 *
		 * @since 2.11.0
		 */
		initializeFormsDefaultObject: function() {

			$( '.wpforms-stripe form' ).each( function() {

				let	formId = $( this ).data( 'formid' );

				app.forms[ formId ] = {
					elements : null,
					paymentElement: null,
					elementsModified: false,
					linkElement: null,
					linkDestroyed: false,
					paymentType: '',
					lockedPageToSwitch: 0,
					paymentMethodId: '',
					total: '',
				};
			} );
		},

		/**
		 * Setup and configure a Stripe form.
		 *
		 * @since 2.10.0
		 */
		setupStripeForm: function() {

			const $form = $( this ),
				$stripeDiv = $form.find( '.wpforms-field-stripe-credit-card' );

			if ( ! $stripeDiv.find( '.wpforms-field-row' ).length ) {
				return;
			}

			let	validator = $form.data( 'validator' );

			if ( ! validator ) {
				return;
			}

			// Store the original submitHandler.
			originalSubmitHandler = validator.settings.submitHandler;

			// Replace the default submit handler.
			validator.settings.submitHandler = app.submitHandler;

			$form.on( 'wpformsAjaxSubmitActionRequired', app.confirmPaymentActionCallback );

			if ( $stripeDiv.hasClass( 'wpforms-conditional-field' ) ) {
				return;
			}

			app.setupPaymentElement( $form );
		},

		/**
		 * Handle confirm payment server response.
		 *
		 * @param {object} e Event object.
		 * @param {object} json Data returned form a server.
		 *
		 * @since 2.10.0
		 */
		confirmPaymentActionCallback: async function( e, json ) {

			if ( ! json.success || ! json.data.action_required ) {
				return;
			}

			const $form = $( this );

			let redirectUrl = new URL( window.location.href ),
				formId = $form.data( 'formid' );

			await app.stripe.confirmPayment(
				{
					clientSecret: json.data.payment_intent_client_secret, // eslint-disable-line camelcase
					confirmParams: {
						return_url: redirectUrl.toString(), // eslint-disable-line camelcase
						payment_method: app.forms[ formId ].paymentMethodId, // eslint-disable-line camelcase
					},
					redirect: 'if_required',
				}
			).then( function( result ) {

				app.handleConfirmPayment( $form, result );
			} );
		},

		/**
		 * Callback for Stripe 'confirmPayment' method.
		 *
		 * @param {jQuery} $form Form element.
		 * @param {object} result Data returned by 'handleCardPayment'.
		 *
		 * @since 2.10.0
		 */
		handleConfirmPayment: function( $form, result ) {

			if ( result.error ) {

				app.displayStripeError( $form, result.error.message );

				return;
			}

			if ( result.paymentIntent && result.paymentIntent.status === 'succeeded' ) {

				$form.find( '.wpforms-stripe-payment-method-id' ).remove();
				$form.find( '.wpforms-stripe-payment-intent-id' ).remove();
				$form.append( '<input type="hidden" class="wpforms-stripe-payment-intent-id" name="wpforms[payment_intent_id]" value="' + result.paymentIntent.id + '">' );
				wpforms.formSubmitAjax( $form );

				return;
			}

			app.formAjaxUnblock( $form );
		},

		/**
		 * Setup, mount and configure Stripe Payment Element.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		setupPaymentElement: function( $form ) {

			let	formId = $form.data( 'formid' );

			if ( app.forms[ formId ].paymentElement ) {
				return;
			}

			const $stripeDiv = $form.find( '.wpforms-field-stripe-credit-card' );

			// Don't setup Payment Element if it's not visible.
			if ( ! $stripeDiv.is( ':visible' ) ) {
				return;
			}

			app.forms[ formId ].elements = app.stripe.elements(
				{
					currency: wpforms.getCurrency().code.toLowerCase(),
					mode: 'payment',
					amount: 1000,
					loader: 'always',
					locale: wpforms_stripe.data.element_locale,
					appearance: app.getElementAppearanceOptions( $form ),
					// eslint-disable-next-line camelcase
					payment_method_types: [ 'card', 'link' ],
				} );

			app.initializePaymentElement( $form );

			app.linkEmailMappedFieldTriggers( $form );

			// Update total amount in case of fixed price.
			wpforms.amountTotalCalc( $form );

			// Update styles in Modern Markup mode.
			app.updatePaymentElementStylesModern( $form );
		},

		/**
		 * Handle Process Conditionals for Stripe field.
		 *
		 * @since 2.10.0
		 *
		 * @param {string} formID  Form ID.
		 * @param {string} fieldID Field ID.
		 * @param {bool}   pass    Pass logic.
		 * @param {string} action  Action to execute.
		 */
		processConditionalsField: function( formID, fieldID, pass, action ) { // eslint-disable-line complexity

			const $form = $( '#wpforms-form-' + formID ),
				$stripeDiv = $form.find( '.wpforms-field-stripe-credit-card' );

			if (
				! $stripeDiv.length ||
				$stripeDiv.data( 'field-id' ).toString() !== fieldID ||
				app.forms[ formID ].paymentElement ||
				! pass ||
				action === 'hide'
			) {
				return;
			}

			app.setupPaymentElement( $form );
		},

		/**
		 * Get Element appearance options.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @returns {object} Appearance options.
		 */
		getElementAppearanceOptions: function( $form ) { // eslint-disable-line max-lines-per-function

			// return early if custom styles are passed.
			if ( typeof window.wpformsStripePaymentElementAppearance === 'object' ) {
				return window.wpformsStripePaymentElementAppearance;
			}

			const $hiddenInput = $form.find( '.wpforms-stripe-credit-card-hidden-input' ),
				$fieldRow = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			let	labelHide = ! $fieldRow.hasClass( 'wpforms-sublabel-hide' );

			const inputStyle = {
				borderColor: $hiddenInput.css( 'border-color' ),
				borderRadius: $hiddenInput.css( 'border-radius' ),
				fontSize: $hiddenInput.css( 'font-size' ),
				colorPrimary: $hiddenInput.css( 'color' ),
				colorText: $hiddenInput.css( 'color' ),
				colorBackground: $hiddenInput.css( 'background-color' ),
				fontFamily: $hiddenInput.css( 'font-family' ),
			};

			if ( window.WPForms && WPForms.FrontendModern ) {
				inputStyle.colorPrimary = WPForms.FrontendModern.getSolidColor( inputStyle.colorPrimary );
			}

			return {
				theme: 'none',
				labels: $fieldRow.data( 'sublabel-position' ),
				variables: {
					colorPrimary: inputStyle.colorPrimary,
					colorBackground: inputStyle.colorBackground,
					colorText: inputStyle.colorText,
					colorDanger: '#990000',
					fontFamily: inputStyle.fontFamily,
					spacingUnit: '4px',
					spacingGridRow: '8px',
					fontSizeSm: '13px',
					fontWeightNormal: '400',
					borderRadius: inputStyle.borderRadius,
				},
				rules: {
					'.Input--invalid': {
						color: inputStyle.colorText,
						borderColor: '#cc0000',
					},
					'.Input': {
						border: '1px solid ' + inputStyle.borderColor,
						borderRadius: inputStyle.borderRadius,
						boxShadow: 'none',
						fontSize: inputStyle.fontSize,
						padding: '6px 10px',
						lineHeight: '24px',
						transition: 'none',
					},
					'.Input:focus': {
						border: '1px solid #999',
						boxShadow: 'none',
						outline: 'none',
					},
					'.Label': {
						fontFamily: inputStyle.fontFamily,
						lineHeight: '1.3',
						opacity: Number( labelHide ),
						color: '#000000',
					},
					'.CheckboxInput, .CodeInput, .PickerItem': {
						border: '1px solid ' + inputStyle.borderColor,
					},
					'.Tab, .Block': {
						border: '1px solid ' + inputStyle.borderColor,
						borderRadius: inputStyle.borderRadius,
					},
					'.Tab--selected': {
						borderColor: '#999999',
					},
					'.Action': {
						marginLeft: '6px',
					},
					'.Action, .MenuAction': {
						border: 'none',
						backgroundColor: 'transparent',
					},
					'.Action:hover, .MenuAction:hover': {
						border: 'none',
						backgroundColor: 'transparent',
					},
				},
			};
		},

		/**
		 * Initialize Payment Element.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 * @param {string} email Email address.
		 */
		initializePaymentElement: function( $form, email = '' ) {

			const $fieldRow = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			let	formId = $form.data( 'formid' );

			if ( app.forms[ formId ].paymentElement ) {
				app.forms[ formId ].paymentElement.destroy();
			}

			app.forms[ formId ].paymentElement = app.forms[ formId ].elements.create( 'payment', { defaultValues : { billingDetails: { email: email } } } );

			app.mountPaymentElement( $form );

			// eslint-disable-next-line complexity
			app.forms[ formId ].paymentElement.on( 'change', function( event ) {

				app.forms[ formId ].paymentType = event.value.type;

				// Destroy link element as it's not required for Google and Apple pay.
				if ( ! $fieldRow.data( 'link-email' ) ) {

					if ( event.value.type === 'google_pay' || event.value.type === 'apple_pay' ) {
						app.forms[ formId ].linkElement.destroy();

						app.forms[ formId ].linkDestroyed = true;
					} else if ( app.forms[ formId ].linkDestroyed ) {
						app.initializeLinkAuthenticationElement( $form );

						app.forms[ formId ].linkDestroyed = false;
					}
				}

				$fieldRow.data( 'type', event.value.type );

				$fieldRow.find( 'label.wpforms-error' ).toggle( event.value.type === 'card' );

				if ( event.empty ) {
					$fieldRow.data( 'completed', false );

					return;
				}

				app.forms[ formId ].elementsModified = true;

				if ( event.complete ) {
					$fieldRow.data( 'completed', true );

					return;
				}

				$fieldRow.data( 'completed', false );
			} );
		},

		/**
		 * Mount Payment Element.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		mountPaymentElement: function( $form ) {

			let	formId = $form.data( 'formid' ),
				paymentRowId = `#wpforms-field-stripe-payment-element-${formId}`;

			app.forms[ formId ].paymentElement.mount( paymentRowId );
		},

		/**
		 * Link Email mapped field triggers.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		linkEmailMappedFieldTriggers: function( $form ) {

			const $fieldRow = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			let	formId = $form.data( 'formid' ),
				linkEmailMappedFieldId = $fieldRow.data( 'link-email' );

			if ( ! linkEmailMappedFieldId ) {

				$fieldRow.data( 'linkCompleted', false );

				app.initializeLinkAuthenticationElement( $form );

				return;
			}

			$( `#wpforms-${formId}-field_${linkEmailMappedFieldId}` ).on( 'change', function() {

				if ( $fieldRow.data( 'completed' ) ) {
					return;
				}

				// Reinitialize payment element if card data not completed yet.
				app.initializePaymentElement( $form, $( this ).val() );
			} );
		},

		/**
		 * Initialize Link Authentication Element.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		initializeLinkAuthenticationElement: function( $form ) {

			const $fieldRow = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			let	formId = $form.data( 'formid' );

			app.forms[ formId ].linkElement = app.forms[ formId ].elements.create( 'linkAuthentication' );

			app.mountLinkElement( $form );

			app.forms[ formId ].linkElement.on( 'change', function( event ) {

				if ( event.empty ) {

					return;
				}

				app.forms[ formId ].elementsModified = true;

				if ( ! event.complete ) {
					$fieldRow.data( 'linkCompleted', false );

					return;
				}

				$fieldRow.data( 'linkCompleted', true );
			} );
		},

		/**
		 * Mount Payment Element.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		mountLinkElement: function( $form ) {

			let	formId = $form.data( 'formid' ),
				linkRowId = `#wpforms-field-stripe-link-element-${formId}`;

			app.forms[ formId ].linkElement.mount( linkRowId );
		},

		/**
		 * Update submitHandler for the forms containing Stripe.
		 *
		 * @since 2.10.0
		 *
		 * @param {object} form JS form element.
		 */
		// eslint-disable-next-line complexity
		submitHandler: function( form ) {

			const $form = $( form ),
				$stripeDiv = $form.find( '.wpforms-field-stripe-credit-card' ),
				$stripeRow = $stripeDiv.find( '.wpforms-field-row' );

			let	valid = $form.validate().form(),
				formId = $form.data( 'formid' ),
				ccRequired = $stripeRow.data( 'required' ),
				cardFilled = ( ! $stripeRow.data( 'link-email' ) && app.forms[ formId ].elementsModified ) || $stripeRow.data( 'completed' ),
				processCard = false;

			if ( ! $stripeDiv.hasClass( 'wpforms-conditional-hide' ) ) {
				processCard = ccRequired || ( cardFilled && ! ccRequired );
			}

			if ( valid && processCard ) {
				$form.find( '.wpforms-submit' ).prop( 'disabled', true );
				$form.find( '.wpforms-submit-spinner' ).show();

				app.createPaymentMethod( $form );

				return;
			}

			if ( valid ) {
				originalSubmitHandler( $form );

				return;
			}

			$form.find( '.wpforms-submit' ).prop( 'disabled', false );
			$form.validate().cancelSubmit = true;
		},

		/**
		 * Update Elements total amount.
		 *
		 * @since 2.10.0
		 *
		 * @param {object} e Event object.
		 * @param {jQuery} $form Form element.
		 * @param {string} total Form total amount.
		 */
		updateElementsTotalAmount: function( e, $form, total ) {

			let currency = wpforms.getCurrency(),
				formId = $form.data( 'formid' );

			if ( ! total || ! app.forms[ formId ].elements ) {
				return;
			}

			// Save total to variable to avoid calling `amountTotalCalc` again in SubmitHandler.
			app.forms[ formId ].total = total;

			// Check if Stripe Elements exist on the form.
			// Can be in a multiple-step form or when the field is hidden by conditional logic.
			if ( ! app.forms[ formId ].elements ) {
				return;
			}

			app.forms[ formId ].elements.update( { amount: parseInt( wpforms.numberFormat( total, currency.decimals, '', '' ), 10 ) } );
		},

		/**
		 * Confirm a setup payment.
		 *
		 * @param {jQuery} $form Form element.
		 */
		createPaymentMethod: async function( $form ) {

			let	formId = $form.data( 'formid' );

			if ( ! app.forms[ formId ].total ) {
				originalSubmitHandler( $form );

				return;
			}

			await app.stripe.createPaymentMethod( {
				elements: app.forms[ formId ].elements,
			} ).then( function( result ) {

				if ( result.error ) {
					app.displayStripeFieldError( $form, result.error.message );

					return;
				}

				app.forms[ formId ].paymentMethodId = result.paymentMethod.id;

				$form.append( '<input type="hidden" class="wpforms-stripe-payment-method-id" name="wpforms[payment_method_id]" value="' + app.forms[ formId ].paymentMethodId + '">' );

				originalSubmitHandler( $form );
			} );
		},

		/**
		 * Unblock the AJAX form.
		 *
		 * @since 2.10.0
		 *
		 * @param {jQuery} $form Form element.
		 */
		formAjaxUnblock: function( $form ) {

			const $submit = $form.find( '.wpforms-submit' );

			let submitText = $submit.data( 'submit-text' );

			if ( submitText ) {
				$submit.text( submitText );
			}

			$submit.prop( 'disabled', false );
			$form.closest( '.wpforms-container' ).css( 'opacity', '' );
			$form.find( '.wpforms-submit-spinner' ).hide();
		},

		/**
		 * Display a generic Stripe Errors.
		 *
		 * @param {jQuery} $form Form element.
		 * @param {string} message Error message.
		 *
		 * @since 2.10.0
		 */
		displayStripeError: function( $form, message ) {

			wpforms.clearFormAjaxGeneralErrors( $form );

			wpforms.displayFormAjaxErrors( $form, message );

			app.formAjaxUnblock( $form );
		},

		/**
		 * Display a field error using jQuery Validate library.
		 *
		 * @param {jQuery} $form Form element.
		 * @param {string} message Error message.
		 *
		 * @since 2.10.0
		 */
		displayStripeFieldError: function( $form, message ) {

			let fieldName = $form.find( '.wpforms-stripe-credit-card-hidden-input' ).attr( 'name' ),
				$stripeDiv = $form.find( '.wpforms-field-stripe-credit-card' ),
				errors = {};

			errors[fieldName] = message;

			wpforms.displayFormAjaxFieldErrors( $form, errors );

			wpforms.scrollToError( $stripeDiv );

			app.formAjaxUnblock( $form );
		},

		/**
		 * Callback for `wpformsBeforePageChange`.
		 *
		 * @since 2.10.0
		 *
		 * @param {Event}  event       Event.
		 * @param {int}    currentPage Current page.
		 * @param {jQuery} $form       Current form.
		 * @param {string} action      The navigation action.
		 */
		pageChange: function( event, currentPage, $form, action ) { // eslint-disable-line complexity

			const $stripeDiv = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			let	formId = $form.data( 'formid' );

			if ( ! $stripeDiv.length || app.forms[ formId ].paymentType !== 'card' ) {
				return;
			}

			if ( ! app.forms[ formId ].elementsModified ) {
				app.forms[ formId ].paymentElement.unmount();
				app.mountPaymentElement( $form );

				if ( ! $stripeDiv.data( 'link-email' ) ) {
					app.forms[ formId ].linkElement.unmount();
					app.mountLinkElement( $form );
				}
			}

			// Stop navigation through page break pages.
			if (
				! $stripeDiv.is( ':visible' ) ||
				( ! $stripeDiv.data( 'required' ) && ! app.forms[ formId ].elementsModified ) ||
				( app.forms[ formId ].lockedPageToSwitch && app.forms[ formId ].lockedPageToSwitch !== currentPage ) ||
				action === 'prev'
			) {
				return;
			}

			const linkCompleted = typeof $stripeDiv.data( 'linkCompleted' ) !== 'undefined' ? $stripeDiv.data( 'linkCompleted' ) : true;

			if ( $stripeDiv.data( 'completed' ) && linkCompleted ) {
				$stripeDiv.find( '.wpforms-error' ).hide();

				return;
			}

			app.forms[ formId ].lockedPageToSwitch = currentPage;

			app.displayStripeFieldError( $form, wpforms_stripe.i18n.empty_details );
			event.preventDefault();
		},

		/**
		 * Callback for `wpformsPageChange`.
		 *
		 * @since 2.11.0
		 *
		 * @param {Event}  event       Event.
		 * @param {int}    currentPage Current page.
		 * @param {jQuery} $form       Current form.
		 * @param {string} action      The navigation action.
		 */
		pageChangeAfter: function( event, currentPage, $form, action ) {

			const formId = $form.data( 'formid' );
			const $stripeDiv = $form.find( '.wpforms-field-stripe-credit-card .wpforms-field-row' );

			if ( ! $stripeDiv.length ) {
				return;
			}

			// Setup Payment Element only after page change.
			// It's needed to correctly initialize the element styles.
			if ( ! app.forms[ formId ].paymentType ) {
				app.setupPaymentElement( $form );
			}
		},

		/**
		 * Callback for `wpformsConvFormsFieldActivationAfter`.
		 *
		 * @since 2.11.0
		 *
		 * @param {Event} event  Event.
		 * @param {object} field CF field object.
		 */
		convFormsFieldActivationAfter: function( event, field ) {

			app.setupPaymentElement( field.$el.closest( 'form' ) );
		},

		/**
		 * Get CSS variable value.
		 *
		 * @since 2.11.0
		 *
		 * @param {object} style   Computed style object.
		 * @param {string} varName Style custom property name.
		 *
		 * @returns {string} CSS variable value;
		 */
		getCssVar: function( style, varName ) {

			let value = style.getPropertyValue( varName ).trim();

			if ( varName.includes( 'color' ) ) {
				value = value.replace( /\s/g, '' );
			}

			return value;
		},

		/**
		 * Update Payment Element styles in Modern Markup mode.
		 *
		 * @since 2.11.0
		 *
		 * @param {jQuery} $form Form object.
		 */
		updatePaymentElementStylesModern: function( $form ) {

			// Should work only in Modern Markup mode.
			if ( ! window.WPForms || ! WPForms.FrontendModern ) {
				return;
			}

			if ( ! $form || $form.length === 0 ) {
				return;
			}

			const formId = $form.data( 'formid' );

			if ( ! app.forms[ formId ] ) {
				return;
			}

			const formElements = app.forms[ formId ].elements;
			const cssVars = WPForms.FrontendModern.getCssVars( $form );

			app.updateFormElementsAppearance( formElements, cssVars );
		},

		/**
		 * Update Payment Elements appearance with given CSS variables data.
		 *
		 * @since 2.11.0
		 *
		 * @param {object} formElements Form payment elements.
		 * @param {object} cssVars      CSS variables data.
		 */
		updateFormElementsAppearance: function( formElements, cssVars ) { // eslint-disable-line max-lines-per-function

			if ( ! formElements || ! formElements._commonOptions ) {
				return;
			}

			// Get existing appearance options.
			let appearance = formElements._commonOptions.appearance;

			// Need to perform vertical padding calculation.
			cssVars['field-size-padding-v'] = ( parseInt( cssVars['field-size-input-height'], 10 ) - parseInt( cssVars['field-size-font-size'], 10 ) - 6 ) / 2 + 'px';

			// Update variables.
			appearance.variables.spacingGridRow = cssVars['field-size-input-spacing'];
			appearance.variables.spacingGridColumn = '20px';
			appearance.variables.spacingTab = '10px';
			appearance.variables.colorText = WPForms.FrontendModern.getSolidColor( cssVars['field-text-color'] );

			// Update rules.
			appearance.rules = {
				'.Input': {
					border: '1px solid ' + cssVars['field-border-color'],
					borderRadius: cssVars['field-border-radius'],
					padding: `${cssVars['field-size-padding-v']} ${cssVars['field-size-padding-h']}`,
					fontSize: cssVars['field-size-font-size'],
					lineHeight: cssVars['field-size-font-size'],
					backgroundColor: cssVars['field-background-color'],
					boxShadow: 'none',
					outline: 'none',
				},
				'.Input:focus': {
					borderColor: cssVars['button-background-color'],
					boxShadow: '0 0 0 1px ' + cssVars['button-background-color'],
					outline: 'none',
				},
				'.Input--invalid': {
					borderColor: cssVars['label-error-color'],
					boxShadow: 'none',
					color: appearance.variables.colorText,
					outline: 'none',
				},
				'.Input--invalid:focus': {
					borderColor: cssVars['label-error-color'],
					boxShadow: '0 0 0 1px ' + cssVars['label-error-color'],
					outline: 'none',
				},
				'.Input::placeholder': {
					color: WPForms.FrontendModern.getColorWithOpacity( cssVars['field-text-color'], '0.5' ),
					fontSize: cssVars['field-size-font-size'],
				},
				'.CheckboxInput': {
					border: '1px solid ' + cssVars['field-border-color'],
					backgroundColor: cssVars['field-background-color'],
				},
				'.CheckboxInput--checked': {
					borderColor: cssVars['button-background-color'],
					backgroundColor: cssVars['button-background-color'],
				},
				'.CodeInput': {
					border: '1px solid ' + cssVars['field-border-color'],
				},
				'.CodeInput:focus': {
					borderColor: cssVars['button-background-color'],
					boxShadow: '0 0 0 1px ' + cssVars['button-background-color'],
					outline: 'none',
				},
				'.CodeInput:disabled': {
					borderColor: WPForms.FrontendModern.getColorWithOpacity( cssVars['field-border-color'], '0.5' ),
					color: WPForms.FrontendModern.getColorWithOpacity( cssVars['field-text-color'], '0.5' ),
				},
				'.Label': {
					fontSize: cssVars['label-size-sublabel-font-size'],
					margin: `0 0 ${cssVars['field-size-sublabel-spacing']} 0`,
					color: cssVars['label-sublabel-color'],
				},
				'.Error': {
					fontSize: cssVars['label-size-sublabel-font-size'],
					margin: `${cssVars['field-size-sublabel-spacing']} 0 0 0`,
					color: cssVars['label-error-color'],
				},
				'.Tab': {
					border: '1px solid ' + WPForms.FrontendModern.getColorWithOpacity( cssVars['field-border-color'], '0.5' ),
					borderRadius: cssVars['field-border-radius'],
					backgroundColor: 'transparent',
					boxShadow: 'none',
					marginTop: '0',
				},
				'.Tab:focus': {
					border: '1px solid ' + WPForms.FrontendModern.getColorWithOpacity( cssVars['button-background-color'], '0.5' ),
					boxShadow: `0 0 0 3px ${WPForms.FrontendModern.getColorWithOpacity( cssVars['button-background-color'], '0.25' )}`,
					outline: 'none',
				},
				'.Tab:hover': {
					border: `1px solid ${cssVars['field-border-color']}`,
				},
				'.Tab--selected': {
					borderColor: cssVars['button-background-color'],
					boxShadow: `0 0 0 1px ${cssVars['button-background-color']}`,
					backgroundColor: cssVars['field-background-color'],
				},
				'.Tab--selected:hover': {
					borderColor: cssVars['button-background-color'],
				},
				'.Tab--selected:focus': {
					borderColor: cssVars['button-background-color'],
					boxShadow: `0 0 0 1px ${cssVars['button-background-color']}`,
				},
				'.TabLabel': {
					color: cssVars['field-text-color'],
				},
				'.TabIcon': {
					fill:  WPForms.FrontendModern.getColorWithOpacity( cssVars['field-text-color'], '0.75' ),
				},
				'.TabIcon--selected': {
					fill:  cssVars['field-text-color'],
				},
				'.TabIcon:hover': {
					color: cssVars['field-text-color'],
					fill: cssVars['field-text-color'],
				},
				'.TabLabel--selected': {
					color: cssVars['button-background-color'],
				},
				'.Block': {
					border: '1px solid ' + WPForms.FrontendModern.getColorWithOpacity( cssVars['field-border-color'], '0.5' ),
					borderRadius: cssVars['field-border-radius'],
					boxShadow: 'none',
				},
			};

			formElements.update( { appearance: appearance } );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsStripePaymentElement.init();
