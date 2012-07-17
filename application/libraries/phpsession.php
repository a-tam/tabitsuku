<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Phpsession {
var $_flash = array();

    // constructor
    function Phpsession() {
        session_start();
        $this->flashinit();
    }
    
    /* Set a session variable.
     * @paramstringName of variable to save
     * @parammixedValue to save
     * @paramstring  (optional) Namespace to use. Defaults to 'default'. 'flash' is reserved.
    */
    function set($var, $val, $namespace = 'default') {
        if ($var == null) {
            $_SESSION[$namespace] = $val;
        } else {
            $_SESSION[$namespace][$var] = $val;
        }
    }
    
    /* Get the value of a session variabe
     * @paramstring  Name of variable to load. null loads all variables in namespace (associative array)
     * @paramstring(optional) Namespace to use, defaults to 'default'
    */
    function get($var = null, $namespace = 'default') {
        if(isset($var))
            return isset($_SESSION[$namespace][$var]) ? $_SESSION[$namespace][$var] : null;
        else
            return isset($_SESSION[$namespace]) ? $_SESSION[$namespace] : null;
    }
    
    /* Clears all variables in a namespace
     */
    function clear($var = null, $namespace = 'default') {
        if(isset($var) && ($var !== null))
            unset($_SESSION[$namespace][$var]);
        else
            unset($_SESSION[$namespace]);
    }

    /**
     * Enter description here ...
     *
     */
    function set_post($ns, $var, $rules) {
		$CI =& get_instance();
		$_data = $this->get_post($ns, $var);
		$data = $CI->input->post();
		$data = array_merge($_data, $data);
		if (isset($_FILES)) {
			$CI->load->library('upload');
			$pattern = $CI->form_validation->allowed_type_pattern();
			foreach($_FILES as $key => $val) {
				$config = array(
						'upload_path' => FCPATH.'uploads/tmp/',
						);
				$param = FALSE;
				if (isset($data[$key."_delete"]) && $data[$key."_delete"] == "1") {
					if ($data[$key]["tmp"]) {
						unlink($data[$key]["tmp"]["full_path"]);
					}
					unset($data[$key]);
					unset($data[$key."_delete"]);
				} else {
					foreach($rules[$key]["rule"] as $rule) {
						if (preg_match("/(.*?)\[(.*?)\]/", $rule, $match)) {
							$rule	= $match[1];
							$param	= $match[2];
						}
						if ($rule == "file_allowed_type" && isset($pattern[$param])) {
							$config['allowed_types'] = implode("|", $pattern[$param]);
							break;
						}
					}
					// 一時ファイルを上書き
					if (isset($data[$key]["tmp"])) {
						$config["file_name"] = $data[$key]["tmp"]["file_name"];
						$config["overwrite"] = true;
						// ファイル名を生成してコピー
					} else {
						$config["overwrite"] = false;
						$config['encrypt_name'] = true;
					}
					$CI->upload->initialize($config);
					if ($CI->upload->do_upload($key)) {
						$data[$key]["tmp"] = $CI->upload->data();
					}
				}
			}
		}
		$this->set($var, $data, $ns);
		return $data;
    }
    
    function get_post($ns, $var) {
    	return $this->get($var, $ns);
    }
    
    /* Initializes the flash variable routines
     */
    function flashinit() {
        $this->_flash = $this->get(null, 'flash');
        $this->clear(null, 'flash');
    }
    
    /* Saves a flash variable. These are only saved for one page load
     * @paramstringVariable name to save
     * @parammixedValue to save
     */
    function flashsave($var, $val) {
        $this->save($var, $val, 'flash');
    }
    
    /* Gets the value of a flash variable. These are only saved for one page load, so the variable must
     * have either been set or had flashkeep() called on the previous page load
     * @paramstringVariable name to get
     */
    function flashget($var) {
        if (isset($this->_flash[$var])) {
            return $this->_flash[$var];
        } else {
            return null;
        }
    }
    
    /* Keeps the value of a flash variable for another page load.
     * @paramstring(optional) Variable name to keep, or null to keep all. Defaults to keep all (null)
     */
    function flashkeep($var = null) {
        if ($var != null) {
            $this->flashsave($var, $this->flashget($var));
        } else {
            $this->save(null, $this->_flash, 'flash');
        }
    }
}