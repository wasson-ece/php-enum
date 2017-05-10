<?php
/**
 * Created by PhpStorm.
 * User: chip
 * Date: 5/10/17
 * Time: 10:48 AM
 */

namespace Wasson_ECE\PHPEnum;


class BasicEnum
{

    /**
     * Return the String Key Value of the supplied const value
     * @param int $value
     * @return null|string
     */
    public static function toString($value)
    {
        if($value == null)
        {
            return null;
        }
        $reflection = new \ReflectionClass(static::class);
        $values = $reflection->getConstants();

        //Check if input value is valid
        if(static::isValid($value, $reflection))
        {
            $constName = array_search($value, $values);
            return static::WordifyConst($constName);
        }
        else
        {
            return null;
        }
    }

    public static function isValid($value, \ReflectionClass $reflection = null)
    {
        if($value == null)
        {
            return false;
        }
        if($reflection == null)
        {
            $reflection = new \ReflectionClass(static::class);
        }
        return in_array($value, $reflection->getConstants());
    }

    /**
     * Generate an HTML Select input for this Enum type, if selected value is supplied, it will be selected.
     * @param null $selectedValue
     * @param array|null $options
     * @return string
     */
    public static function toSelect($selectedValue = null, array $options = null)
    {
        $selectOptions = array();
        $selectOptions['class'] = $options['class'] ?? "";
        $selectOptions['id'] = $options['id'] ?? "";
        $selectOptions['name'] = $options['name'] ?? "";

        $reflection = new \ReflectionClass(static::class);

        $html = "<select class='".$selectOptions['class']."' name='".$selectOptions['name']."'>";
        foreach($reflection->getConstants() as $constant => $value)
        {
            $html .= "<option value='{$value}' ".static::isSelectedHTML($selectedValue, $value).">".
                self::WordifyConst($constant)."</option>";
        }
        $html .= "</select>";
        return $html;
    }

    /**
     * Returns a selected HTML attribute if the values are the same.
     * @param int $selected
     * @param int $thisVal
     * @return string
     */
    private static function isSelectedHTML($selected, int $thisVal)
    {
        return ($selected == $thisVal ? " selected='true'" : "");
    }

    public static function UseThisFunctionIfYouWantToTurnAConstStringWithCapitalLettersIntoAStringWithSpaces(
        string $constName)
    {
        return static::WordifyConst($constName);
    }

    private static function WordifyConst(string $constName)
    {
        return trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $constName));
    }
}