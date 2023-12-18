<?php

if (!function_exists('userdata')) {
    /**
     * get userdata session by key or all
     * @param null|string $param userdata key
     */
    function userdata(?string $param = null)
    {
        $session = \Config\Services::session();

        if ($param === null) {
            $sesdata = $session->get();

            $userdata = array_filter($sesdata, function ($key) {
                return strpos($key, 'userdata_') === 0;
            }, ARRAY_FILTER_USE_KEY);

            if (!empty($userdata)) {
                $keys = array_map(function ($key) {
                    return substr($key, strlen('userdata_'));
                }, array_keys($userdata));
                $vals = array_values($userdata);

                $userdata = array_combine($keys, $vals);
            }
            return empty($userdata) ? null : $userdata;
        } else {
            return $session->get('userdata_' . $param);
        }
    }
}

if (!function_exists('set_userdata')) {
    /**
     * setup session userdata
     */
    function set_userdata(array $data)
    {
        $session = \Config\Services::session();

        $set = array();
        foreach ($data as $k => $v) $set['userdata_' . $k] = $v;

        $session->set($set);
    }
}

if (!function_exists('remove_userdata')) {
    /**
     * remove userdata session
     * @param null|string|array $keys userdata key
     */
    function remove_userdata($keys = null)
    {
        $session = \Config\Services::session();
        $remove = array();

        if ($keys === null) {
            $sesdata = $session->get();
            $userdata = array_filter($sesdata, function ($key) {
                return strpos($key, 'userdata_') === 0;
            }, ARRAY_FILTER_USE_KEY);
            $remove = array_keys($userdata);
        } elseif (is_string($keys)) {
            array_push($remove, 'userdata_' . $keys);
        } elseif (is_array($keys)) {
            foreach ($keys as $k) array_push($remove, 'userdata_' . $k);
        }
        $session->remove($remove);
    }
}

if (!function_exists('is_login')) {
    /**
     * check login status
     */
    function is_login(): bool
    {
        $check_keys = array(
            'id', 'user', 'nama', 'foto', 'office', 'role'
        );

        $session = \Config\Services::session();
        $checked = array();

        foreach ($check_keys as $cek)  $checked[] = $session->has('userdata_' . $cek);
        $result = count(array_unique($checked)) === 1 && !in_array(false, $checked);

        return $result;
    }
}

if (!function_exists('login_page')) {
    function login_page(string $url)
    {
        $session = \Config\Services::session();
        $session->setFlashdata('requested_url', $url);
        return redirect()->to('');
    }
}

if (!function_exists('role_is')) {
    /**
     * Cek apakah Role ID sama seperti di dalam Array
     */
    function role_is(array $roles): bool
    {
        $result = false;
        $session = \Config\Services::session();
        $role = intval($session->get('userdata_role_id'));
        foreach ($roles as $rl) if ($role === intval($rl)) $result = true;
        return $result;
    }
}
