<?php

/**
 * @param int $status
 */
function abort($status = 404)
{
    require "./../app/view/errors/$status.php";
    exit();
}

/**
 * @param $arr
 * @param bool $is_die
 */
function pretty($arr, $is_die = false)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';

    if ($is_die) die();
}

/**
 * @param $view
 * @param array $data
 */
function view($view, $data = [])
{
    extract($data);

    require "../app/view/layouts/master.php";
}

/**
 * @param string $path
 * @return string
 */
function asset($path = '')
{
    return APP_URL . trim($path, '/');
}

/**
 * @param string $url
 * @return string
 */
function url($url = '')
{
    return APP_URL . trim($url, '/');
}

/**
 * @param string $url
 */
function redirect($url = '')
{
    if ($url) {
        $location = APP_URL . trim($url, '/');
        header("location: $location");
        die();
    }
}

/**
 * @param $key
 * @return mixed|string
 */
function session_get($key)
{
    if ($key && isset($_SESSION[$key])) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
}

/**
 * @param string $key
 * @param string $value
 */
function session_set($key = '', $value = '')
{
    if ($key && $value) {
        $_SESSION[$key] = $value;
    }
}

/**
 * @param $key
 * @return bool
 */
function session_has($key)
{
    return isset($_SESSION[$key]);
}

/**
 * @param string $key
 */
function session_del($key = '')
{
    if ($key && isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

/**
 * @param int $total
 * @param int $count
 */
function pagination($total = 0, $count = 10)
{
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';

    $start = 0;
    for ($i = 0; $i < $total; $i += $count) {
        $start++;
        echo '<li class="page-item ';
        echo (isset($_GET['start']) ? $_GET['start'] : '') == $i ? 'active' : '';
        echo '">';
        echo '<a class="page-link" href="' . url('post?start=' . $i) . '">';
        echo $start;
        echo '</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
}
