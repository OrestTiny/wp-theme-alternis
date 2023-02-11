<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
  <input type="search" value="<?php echo get_search_query() ?>" name="s" id="s"
    placeholder="<?php esc_attr_e('Type and hit enter...', 'alternis'); ?>" />
  <button type="submit" id="searchsubmit">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" fill="none">
      <path
        d="M8.25 15C11.9779 15 15 11.9779 15 8.25C15 4.52208 11.9779 1.5 8.25 1.5C4.52208 1.5 1.5 4.52208 1.5 8.25C1.5 11.9779 4.52208 15 8.25 15Z"
        stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
      <path d="M16.5 16.5L13.5 13.5" stroke="black" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round">
      </path>
    </svg>
  </button>
</form>