<?php 
/*
Plugin Name: Show Paybright MDP
Plugin URI: show-paybright-mdp
Description: This plugin shows the total of the cart divided by 4 if it's more than 200
Author: Mahdi Mouttahid
Version: 2.1.0
Author URI: http://mouttahid.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or die;

class ShowPaybright{
    
    function __construct()
    {
        add_action('woocommerce_proceed_to_checkout',[$this,'paybright_text']);
        add_action('woocommerce_widget_shopping_cart_before_buttons',[$this,'paybright_text']);
        add_action('woocommerce_before_add_to_cart_form',[$this,'paybright_text_single']);	
    }

    function register()
    {
        add_action('wp_enqueue_scripts', [$this,'enqueue']);
        add_shortcode( 'showpaybright-mdp', array($this,'showpaybright_shortcode') );
    }


    //methods
    function activate(){
    }

    function deactivate(){
    }

    function uninstall(){
    }

    function custom_post_type(){
    }

    function enqueue() {
        wp_enqueue_style( 'mypluginstyle', plugins_url('assets/css/style.css',__FILE__) );
    }

	function showpaybright_shortcode(){
        if(WC()->cart->total>= 200){
            $total = number_format((float)WC()->cart->total/4, 2, '.', '');
            $total = wc_price($total);
            $image = plugins_url( "/assets/img/paybright.png",__FILE__  );
        echo "<p class='pbm-headline'>4 paiements de $total sans frais et sans intérêt avec <img class='pbm-image' src='$image' /></p>";
    	}
	 }

    function paybright_text(){
        if(WC()->cart->total>= 200){
            $total = number_format((float)WC()->cart->total/4, 2, '.', '');
            $total = wc_price($total);
            $image = plugins_url( "/assets/img/paybright.png",__FILE__  );
        echo "<p class='pbm-headline'>4 paiements de $total sans frais et sans intérêt avec <img class='pbm-image' src='$image' /></p>";
    	}
	}
		
	function paybright_text_single(){
		
        $image = plugins_url( "/assets/img/paybright.png",__FILE__  );
        echo "<p class='pbm-small'>Payez en 4 versements sans frais et sans intérêt sur les commandes de 200$+ avec <img class='pbm-image' src='$image' /> &nbsp<a 		href='/paybright' target='_blank' class='pbm-link'>Voir les détails</a></p>";
	}



}

if( class_exists('ShowPaybright') )
{
    $showPaybright = new ShowPaybright();
    $showPaybright->register();

// activation
register_activation_hook( __FILE__, [$showPaybright,'activate']);

// deactivation
register_deactivation_hook( __FILE__, [$showPaybright, 'deactivate']);

}



