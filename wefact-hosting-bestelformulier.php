<?php
/*
Plugin Name: WeFact Hosting bestelformulier integratie
Plugin URI: https://www.wefact.nl/
Description: Eenvoudige manier om het bestelformulier van WeFact Hosting in de Wordpress website te integreren. Zie <a href="https://www.wefact.nl/wefact-hosting/help/artikel/87/bestelformulier-integreren-in-een-wordpress-website/">https://www.wefact.nl/wefact-hosting/help/artikel/87/bestelformulier-integreren-in-een-wordpress-website/</a> voor meer informatie.
Version: 1.2
Author: WeFact
Author URI: https://www.wefact.nl
License: GPLv2 or later
*/
// Load scripts needed
add_action('wp_enqueue_scripts', array('WeFactHostingBestelformulier', 'loadScripts')); 

// Add shortcode
add_shortcode('bestelformulier', array('WeFactHostingBestelformulier', 'shortcode'));


class WeFactHostingBestelformulier
{
	/**
	 * WeFactHostingBestelformulier::loadScripts()
	 * 
	 * @return void
	 */
	public function loadScripts()
	{
		// Load Javascript file
        wp_register_script('wf-orderform', plugins_url('wf-orderform.js', __FILE__)); 
        wp_enqueue_script('wf-orderform'); 
    }

    /**
     * WeFactHostingBestelformulier::shortcode()
     * 
     * @param mixed $attributes
     * @return HTML
     */
    public function shortcode($attributes)
	{
		if(isset($attributes['url']) && $attributes['url'])
		{
			// Add extra GET-parameters? Currenly supported: domain, hosting, ssl and/or product
			if(isset($_GET['domain']))
			{
				$attributes['url'] .= ((strpos($attributes['url'], '?') !== FALSE) ? '&' : '?') . 'domain=' . htmlspecialchars($_GET['domain']);
			}
			if(isset($_GET['hosting']))
			{
				$attributes['url'] .= ((strpos($attributes['url'], '?') !== FALSE) ? '&' : '?') . 'hosting=' . htmlspecialchars($_GET['hosting']);
			}
			if(isset($_GET['ssl']))
			{
				$attributes['url'] .= ((strpos($attributes['url'], '?') !== FALSE) ? '&' : '?') . 'ssl=' . htmlspecialchars($_GET['ssl']);
			}
			if(isset($_GET['product']))
			{
				$attributes['url'] .= ((strpos($attributes['url'], '?') !== FALSE) ? '&' : '?') . 'product=' . htmlspecialchars($_GET['product']);
			}
			
			return '<iframe src="'.$attributes['url'].'" scrolling="no" class="wf-orderform" style="width:100%;border:0;overflow-y:hidden;"></iframe>';
		}
        
        return '';
    }
}