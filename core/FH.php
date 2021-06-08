<?php
namespace Core;
use Core\Session;
use Core\H;

class FH {

  /**
   * Creates an input block to be used in a form
   * @method inputBlock
   * @param  string     $type       type of input ie text, password, phone ...
   * @param  string     $label      The label that will be displayed for the input
   * @param  string     $name       The id and name of the input will be set to this value
   * @param  string     $value      (optional) The value of the input
   * @param  array      $inputAttrs (optional) attributes of input
   * @param  array      $divAttrs   (optional) attributes of surrounding div
   * @param  array      $errors     (optional) array of all form errors
   * @return string                 returns an html string for input block
   */
  public static function inputBlock($type, $label, $name, $value='', $inputAttrs=[], $divAttrs=[],$errors=[], $other=''){
    $inputAttrs = self::appendErrorClass($inputAttrs,$errors,$name,'is-invalid');
    $divString = self::stringifyAttrs($divAttrs);
    $inputString = self::stringifyAttrs($inputAttrs);
    $id = str_replace('[]','',$name);
    $html = '<div' . $divString . '>';
    $html .= '<label class="control-label" for="'.$id.'">'.$label.'</label>';
    $html .= '<input type="'.$type.'" id="'.$id.'" name="'.$name.'" $other value="'.$value.'"'.$inputString.$other.' />';
    $html .= '<span class="invalid-feedback">'.self::errorMsg($errors,$name).'</span>';
    $html .= '</div>';
    return $html;
  }

  /**
   * Creates a submit input
   * @method submitTag
   * @param  string    $buttonText Text that will be displayed on button
   * @param  array     $inputAttrs (optional) Attributes of input
   * @return string                Returns an html string for submit button
   */
  public static function submitTag($buttonText, $inputAttrs=[]){
    $inputString = self::stringifyAttrs($inputAttrs);
    $html = '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
    return $html;
  }

  /**
   * Creates a submit block
   * @method submitBlock
   * @param  string      $buttonText Text that will be displayed on button
   * @param  array       $inputAttrs (optional) Attributes for input
   * @param  array       $divAttrs   (optional) Atributes for surrounding div
   * @return string                  Returns an html string for submit block
   */
  public static function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[]){
    $divString = self::stringifyAttrs($divAttrs);
    $inputString = self::stringifyAttrs($inputAttrs);
    $html = '<div'.$divString.'>';
    $html .= '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
    $html .= '</div>';
    return $html;
  }

  /**
   * Creates a checkbox block
   * @method checkboxBlock
   * @param  string        $label      Text of label of checkbox
   * @param  string        $name       id and name of checkbox
   * @param  boolean       $checked    (optional) Checks the checkbox on true
   * @param  array         $inputAttrs (optional) Attributes for checkbox
   * @param  array         $divAttrs   (optional) Attributes for surrounding div
   * @param  array         $errors     (optional) Pass in all form errors
   * @return string                    Returns an html string for checkbox block
   */
  public static function checkboxBlock($label,$name,$checked=false,$inputAttrs=[],$divAttrs=[],$errors=[]){
    $inputAttrs = self::appendErrorClass($inputAttrs,$errors,$name,'is-invalid');
    $divString = self::stringifyAttrs($divAttrs);
    $inputString = self::stringifyAttrs($inputAttrs);
    $checkString = ($checked)? ' checked="checked"' : '';
    $id = str_replace('[]','',$name);
    $html = '<div'.$divString.'>';
    $html .= '<label for="'.$id.'" class="control-label">'.$label.' <input type="checkbox" id="'.$id.'" name="'.$name.'" value="on"'.$checkString.$inputString.'>';
    $html .= '<span class="invalid-feedback">'.self::errorMsg($errors,$name).'</span>';
    $html .= '</label>';
    $html .= '</div>';
    return $html;
  }

  /**
   * Creates a Select Block
   * @method selectBlock
   * @param  string      $label      Text for label
   * @param  string      $name       id and name for select
   * @param  string      $value      value of select
   * @param  array       $options    options for select the ['value for option'=>'Display of Option']
   * @param  array       $inputAttrs (optional) Attributes for select
   * @param  array       $divAttrs   (optional) Attributes for surrounding div
   * @param  array       $errors     (optional) Pass in form errors
   * @return string                  Returns an html string for select block
   */
  public static function selectBlock($label,$name,$value,$options,$inputAttrs=[],$divAttrs=[],$errors=[]){
    $inputAttrs = self::appendErrorClass($inputAttrs,$errors,$name,'is-invalid');
    $divString = self::stringifyAttrs($divAttrs);
    $inputString = self::stringifyAttrs($inputAttrs);
    $id = str_replace('[]','',$name);
    $html = '<div' . $divString . '>';
    $html .= '<label for="'.$id.'" class="control-label">' . $label . '</label>';
    $html .= '<select id="'.$id.'" name="'.$name.'" '.$inputString.'>'.self::optionsForSelect($options,$value).'</select>';
    $html .= '<span class="invalid-feedback">'.self::errorMsg($errors,$name).'</span>';
    $html .= '</div>';
    return $html;
  }

  /**
   * Creates a textarea block
   * @method textareaBlock
   * @param  string        $label      Text for label
   * @param  string        $name       id and name for textarea
   * @param  string        $value      value of text area
   * @param  array         $inputAttrs (optional) Attributes for textarea
   * @param  array         $divAttrs   (optional) Attributes for surrounding div
   * @param  array         $errors     (optional) Pass in the form errors
   * @return string                    Returns an html string for textarea block
   */
  public static function textareaBlock($label,$name,$value,$inputAttrs=[],$divAttrs=[],$errors=[]){
    $inputAttrs = self::appendErrorClass($inputAttrs,$errors,$name,'is-invalid');
    $divString = self::stringifyAttrs($divAttrs);
    $inputString = self::stringifyAttrs($inputAttrs);
    $id = str_replace('[]','',$name);
    $html = '<div' . $divString . '>';
    $html .= '<label for="'.$id.'" class="control-label">' . $label . '</label>';
    $html .= '<textarea id="'.$id.'" name="'.$name.'"'.$inputString.'>'.$value.'</textarea>';
    $html .= '<span class="invalid-feedback">'.self::errorMsg($errors,$name).'</span>';
    $html .= '</div>';
    return $html;
  }

  /**
   * Creates a hidden input field
   * @method hiddenInput
   * @param  string      $name  name and id of the hidden input
   * @param  string      $value input value
   * @return string             Returns an html string for hidden input field
   */
  public static function hiddenInput($name,$value){
    $html = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
    return $html;
  }

    /**
   * Turns an array of attributes into an attribute string to be used in an html tag
   * @method stringifyAttrs
   * @param  array          $attrs ['class'=>'foo'] will return class="foo"
   * @return string                string to be used in html tag
   */
  public static function stringifyAttrs($attrs){
    $string = '';
    foreach($attrs as $key => $val){
      $string .= ' ' . $key . '="' . $val . '"';
    }
    return $string;
  }

  /**
   * Creates a csrf token and stores it in $_SESSION
   * @method generateToken
   * @return string        value of the token set in $_SESSION
   */
  public static function generateToken(){
    $token = base64_encode(openssl_random_pseudo_bytes(32));
    Session::set('csrf_token',$token);
    return $token;
  }

  /**
   * Check to see if the csrf token is valid
   * @method checkToken
   * @param  string     $token value that was posted
   * @return boolean           returns whether or not the token was correct
   */
  public static function checkToken($token){
    return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
  }

  /**
   * Creates a hidden input to be used in a form for csrf
   * @method csrfInput
   * @return string    return html string for form input
   */
  public static function csrfInput(){
    return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'" />';
  }

  /**
   * Cleans user input with htmlentities
   * @method sanitize
   * @param  string   $dirty string of dirty user input
   * @return string          string of cleaned user input
   */
  public static function sanitize($dirty) {
    return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
  }

  /**
   * Creates a styled list of form errors used to display on front-end to user.
   * @method displayErrors
   * @param  array         $errors pass in the form errors ['field'=>'message']
   * @return string                return html string with styled form errors.
   */
  public static function displayErrors($errors) {
    $hasErrors = (!empty($errors))? ' has-errors' : '';
    $html = '<div class="form-errors"><ul class="bg-light'.$hasErrors.'">';
    foreach($errors as $field => $error) {
      $html .= '<li class="text-danger">'.$error.'</li>';
    }
    $html .= '</ul></div>';
    return $html;
  }


  /**
   * adds an error class name to attrs if there is an error
   * @method appendErrorClass
   * @param  array       $divAttrs default div attributes array
   * @param  array       $errors   pass in the form errors
   * @param  string      $name     name of the field
   * @param  string      $class    class name to be applied
   * @return array                 returns an array with an appended class in the div attributes array
   */
  public static function appendErrorClass($attrs,$errors,$name,$class){
    if(array_key_exists($name,$errors)){
      if(array_key_exists('class',$attrs)){
        $attrs['class'] .= " " . $class;
      } else {
        $attrs['class'] = $class;
      }
    }
    return $attrs;
  }

  /**
   * Returns an error message for the input
   * @method errorMsg
   * @param  array    $errors pass in the form errors
   * @param  string   $name   id and name of the input
   * @return string           returns the error message from the form errors
   */
  public static function errorMsg($errors,$name){
    $msg = (array_key_exists($name,$errors))? $errors[$name] : "";
    return $msg;
  }

  /**
   * Turns an associative array into options for a select element
   * @method optionsForSelect
   * @param  array            $options ['option value'=>'Label for option']
   * @return string                    returns html string to be used in select html elements
   */
  public static function optionsForSelect($options,$selectedValue){
    $html = "";
    foreach($options as $value => $display){
      $selStr = ($selectedValue == $value)? ' selected="selected"' : '';
      $html .= '<option value="'.$value.'"'.$selStr.'>'.$display.'</option>';
    }
    return $html;
  }

  public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = '41.220.125.86';
            //$ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        //H::dnd($output);
        return $output;
    }

    public static function getCurrencyAndCode(){
      $country = self::ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)["country"];
      //$country = '';
      $currency = ($country=='Kenya' ? 'KES (Kenya Shilling)' : 'USD (US Dollar)');
      $currencyCode = ($currency== 'USD (US Dollar)') ? '$' : 'KES ';
      $currencyExRate = ($currencyCode == 'KES ')? KENYA_SHILLING_EXCHANGE_RATE : 1;
      return ['currency'=> $currency ,'currencyCode' => $currencyCode, 'currencyExRate'=>$currencyExRate];
    }

    public static function numFormatAndExRated($x,$currencyExRate){
      return number_format(($x*$currencyExRate),2);
    }

}
