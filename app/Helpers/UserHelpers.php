<?php

/**
 * Returns the authenticated user.
 *
 * @return array
 */
function getAuthenticatedUser() {
    return Auth::user();
}

/**
 * Returns true or false if user is authenticated or not.
 *
 * @return boolean
 */
function isAuthenticUser() {
    return Auth::check();
}

/**
 * Return true of false if user has a role
 * 
 * @param type $role
 * @return boolean
 */
function hasRole($role) {
    if(isAuthenticUser()) {
        return getAuthenticatedUser()->hasRole($role);
    }
    
    return false;
}