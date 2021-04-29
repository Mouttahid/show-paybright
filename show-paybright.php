<?php 
/*
Plugin Name: Show Paybright MDP
Plugin URI: show-paybright-mdp
Description: This plugin shows the total of the cart divided on 4 payments
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
        // add_action('init',array( $this, 'custom_post_type' ));
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
    function activate()
    {
        // $this->custom_post_type();
        // flush_rewrite_rules();
    }

    function deactivate(){

    }

    function uninstall(){

    }

    function custom_post_type(){

        // register_post_type( 'mt_gallery',
        //     array(
        //         'labels' => array(
        //                         'name' => __( 'Gallery' ),
        //                         'singular_name' => __( 'Gallery' ),
        //                         'all_items' => __( 'All Images')
        //                     ),
        //         'public' => true,
        //         'has_archive' => false,
        //         'exclude_from_search' => true,
        //         'rewrite' => array('slug' => 'gallery-item'),
        //         'supports' => array( 'title', 'thumbnail' ),
        //         'menu_position' => 4,
        //         'show_in_admin_bar'   => false,
        //         'show_in_nav_menus'   => false,
        //         'publicly_queryable'  => false,
        //         'query_var'           => false
        //     )
    // );
    
    }

    function enqueue() {
        wp_enqueue_style( 'mypluginstyle', plugins_url('assets/css/style.css',__FILE__) );
//         wp_enqueue_style( 'lightgallerycss','https://cdn.jsdelivr.net/npm/lightgallery.js@1.4.0/src/css/lightgallery.css' );
//         wp_enqueue_script( 'lightgallery', 'https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js',[],false,true);
//         wp_enqueue_script( 'myscript', plugins_url('assets/main.js',__FILE__));
//         wp_enqueue_script( 'lightgallery', 'https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js',[],false,true);

    }
    
    // function gallery_shortcode()
    // {
    //     include 'mt_gallery_template.php';
    // }
    
	 function showpaybright_shortcode()
    {
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



