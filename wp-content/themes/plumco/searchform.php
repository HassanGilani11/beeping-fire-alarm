<?php 
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 */

?>
<div class="search-widget">
   <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="searchform" >
        <div>
           <input type="text" name="s" id="plumco-search" placeholder="<?php echo esc_attr__( 'Search...','plumco' ); ?>">
            <button type="submit"><i class="ti-search"></i></button>
        </div>
    </form>
</div>
