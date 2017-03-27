package com.guideapp.backend.util;


public final class StringUtil {

    /**
     * Constructor
     */
    private StringUtil() {
    }

    /**
     * Remove white space in a String
     *
     * @param s the String
     * @return a String without white space
     */
    public static String trim(String s) {
        if (s == null) {
            return "";
        }

        return s.trim();
    }
}
