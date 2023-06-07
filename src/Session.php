<?php

namespace PaulinhoSupriano\Session;

/**
 * Class Session
 * @package Session
 * Developer Name: PaulinhoSupriano
 * Facebook : https://www.facebook.com/paulinhosupriano
 */
class Session {

    /**
     * Session constructor.
     */
    public function __construct() {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * @param $name
     * @return null|mixed
     */
    public function __get($name) {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name) {
        return $this->has($name);
    }

    /**
     * @return null|object
     */
    public function all() {
        return (object)$_SESSION;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Session
     */
    public function set(string $key, $value): Session {
        $_SESSION[$key] = (is_array($value) ? (object) $value : $value);
        return $this;
    }

    /**
     * @param array $data
     * @param $nameSession
     * @return Session
     */
    public function setData(array $data, $nameSession): Session {
        $_SESSION[$nameSession] = $data;
        return $this;
    }

    public function getData($nameSession) {
        if (isset($_SESSION[$nameSession])) {
            return $_SESSION[$nameSession];
        }
        return false;
    }

    /**
     * Remove campo da sessão
     * @param string $key
     * @return Session
     */
    public function pull(string $key) {
        unset($_SESSION[$key]);
        return $this;
    }

    /**
     * verifica se existe o campo
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    /**
     * @return Session
     */
    public function regenerate(): Session {
        session_regenerate_id(true);
        return $this;
    }

    /**
     * @return Session
     */
    public function destroy(): Session {
        session_destroy();
        return $this;
    }

    /**
     * CSRF Token
     */
    public static function csrf($name): void {
        $_SESSION['csrf_token'][$name] = md5(uniqid(rand(), true));
    }

}
