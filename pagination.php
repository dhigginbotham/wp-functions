<?php
function dh_pagination() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;
  $a['type'] = 'array';
 
  $total = 1; //1 - display the text "Page N of N", 0 - not display
  $a['mid_size'] = 5; //how many links to show on the left and right of the current
  $a['end_size'] = 1; //how many links to show in the beginning and end
  $a['prev_text'] = '&laquo; Previous'; //text of the "Previous page" link
  $a['next_text'] = 'Next &raquo;'; //text of the "Next page" link

  $conf['container_elem'] = 'ul'; //set your container
  $conf['child_elem'] = 'li';
  $conf['container_class'] = 'pagination'; //set your container
  $conf['count_class'] = 'page'; //set your page count class
 
  if ($max > 1) echo '<' . $conf['container_elem'] . ' class="' . $conf['container_class'] . '">';
  if ($total == 1 && $max > 1) $pages = '<' . $conf['child_elem'] . ' class="' . $conf['count_class'] . '">Page ' . $current . ' of ' . $max . '</' . $conf['child_elem'] . '>'."\r\n";
  $page_array = paginate_links($a);
  echo $pages;
  for ($i = 0; $i < count($page_array); ++$i) {
    echo "<li>" . $page_array[$i] . "</li>\r\n";
  }
  if ($max > 1) echo '</' . $conf['container_elem'] . '>';
}

//usage
// if (function_exists('dh_pagination')) dh_pagination();