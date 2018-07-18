<?php

/**
  Template Name: Registrering
  * based on wp-signup.php
 */

/** Sets up the WordPress Environment. */
require( '/srv/www/wp-load.php' );

add_action( 'wp_head', 'wp_no_robots' );

require('/srv/www/wp-blog-header.php' );

if ( is_array( get_site_option( 'illegal_names' )) && isset( $_GET[ 'new' ] ) && in_array( $_GET[ 'new' ], get_site_option( 'illegal_names' ) ) ) {
	wp_redirect( network_home_url() );
	die();
}


/**
 * Prints signup_header via wp_head
 *
 * @since MU
 */
function do_signup_header() {
	/**
	 * Fires within the head section of the site sign-up screen.
	 *
	 * @since 3.0.0
	 */
	do_action( 'signup_header' );
}
add_action( 'wp_head', 'do_signup_header' );

if ( !is_multisite() ) {
	wp_redirect( wp_registration_url() );
	die();
}

if ( !is_main_site() ) {
	wp_redirect( network_site_url( 'custom-register.php' ) );
	die();
}

// Fix for page title
$wp_query->is_404 = false;

/**
 * Fires before the Site Signup page is loaded.
 *
 * @since 4.4.0
 */
do_action( 'before_signup_header' );

/**
 * Prints styles for front-end Multisite signup pages
 *
 * @since MU
 */
function wpmu_signup_stylesheet() {
	?>
	<style type="text/css">
		.mu_register { width: 90%; margin:0 auto; }
		.mu_register form { margin-top: 2em; }
		.mu_register .error { font-weight:700; padding:10px; color:#333333; background:#FFEBE8; border:1px solid #CC0000; }
		.mu_register input[type="submit"],
			.mu_register #blog_title,
			.mu_register #user_email,
			.mu_register #blogname,
			.mu_register #user_name { width:100%; font-size: 24px; margin:5px 0; }
		.mu_register #site-language { display: block; }
		.mu_register .prefix_address,
			.mu_register .suffix_address {font-size: 18px;display:inline; }
		.mu_register label { font-weight:700; font-size:15px; display:block; margin:10px 0; }
		.mu_register label.checkbox { display:inline; }
		.mu_register .mu_alert { font-weight:700; padding:10px; color:#333333; background:#ffffe0; border:1px solid #e6db55; }
	</style>
	<?php
}

add_action( 'wp_head', 'wpmu_signup_stylesheet' );
get_header( 'custom-register' );

/**
 * Fires before the site sign-up form.
 *
 * @since 3.0.0
 */
do_action( 'before_signup_form' );
?>
<div id="signup-content" class="widecolumn">
<div class="mu_register custom-register-container">
<?php

/**
* Check if submitted mail is Chalmers student mail
*/
function check_email( $errors, $user_email ) {
  list( ,$email_domain ) = explode( '@', $user_email, 2 );
  if ( ! preg_match('/student.chalmers.se/', $email_domain ) ) {
    $errors->add( 'user_email', __( '<strong>ERROR</strong>: Ange din studentmail: cid@student.chalmers.se.', 'my_textdomain' ) );
  }

  return $errors;
}

add_filter( 'registration_errors', 'check_email', 10, 3 );

/**
 * Display user registration form
 *
 * @since MU
 *
 * @param string          $user_name  The entered username.
 * @param string          $user_email The entered email address.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function show_user_form($user_name = '', $user_email = '', $errors = '') {
	if ( ! is_wp_error( $errors ) ) {
		$errors = new WP_Error();
	}

	?>

	<label for="user_email"><?php _e( 'Email&nbsp;Address:' ) ?></label>
	<?php if ( $errmsg = $errors->get_error_message('user_email') ) { ?>
		<p class="error"><?php echo $errmsg ?></p>
	<?php } ?>
	<input name="user_email" type="email" id="user_email" value="<?php  echo esc_attr($user_email) ?>" maxlength="200" /><br /><?php _e('Vi skickar ditt registreringsmail till denna adress. Kontrollera att ditt användarnamn blir ditt cid.') ?>
	<?php
	if ( $errmsg = $errors->get_error_message('generic') ) {
		echo '<p class="error">' . $errmsg . '</p>';
	}

        echo "<h3> Användarnamn: " . $user_name . "</h3>";

        // it doesn't work without the form...
        echo '<input name="user_name" type="hidden" id="user_name" value="'. esc_attr( $user_name ) .'" autocapitalize="none" autocorrect="off" maxlength="60" /><br />';


        // must press "Next" button twice. Missing username error will show up after the first click unless this is commented out.	
       // if ( $errmsg = $errors->get_error_message('user_name') ) {
       //   echo '<p class="error">'.$errmsg.'</p>';
       // }
        
        /**
	 * Fires at the end of the user registration form on the site sign-up form.
	 *
	 * @since 3.0.0
	 *
	 * @param WP_Error $errors A WP_Error object containing containing 'user_name' or 'user_email' errors.
	 */
	do_action( 'signup_extra_fields', $errors );

}

/**
 * Validate user signup name and email
 *
 * @since MU
 *
 * @return array Contains username, email, and error messages.
 */
function validate_user_form() {
  return wpmu_validate_user_signup($_POST['user_name'], $_POST['user_email']);
}

/**
 * Allow returning users to sign up for another site
 *
 * @since MU
 *
 * @param string          $blogname   The new site name
 * @param string          $blog_title The new site title.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function signup_another_blog( $blogname = '', $blog_title = '', $errors = '' ) {
	$current_user = wp_get_current_user();

	if ( ! is_wp_error($errors) ) {
		$errors = new WP_Error();
	}

	$signup_defaults = array(
		'blogname'   => $blogname,
		'blog_title' => $blog_title,
		'errors'     => $errors
	);

	/**
	 * Filters the default site sign-up variables.
	 *
	 * @since 3.0.0
	 *
	 * @param array $signup_defaults {
	 *     An array of default site sign-up variables.
	 *
	 *     @type string   $blogname   The site blogname.
	 *     @type string   $blog_title The site title.
	 *     @type WP_Error $errors     A WP_Error object possibly containing 'blogname' or 'blog_title' errors.
	 * }
	 */
	$filtered_results = apply_filters( 'signup_another_blog_init', $signup_defaults );

	$blogname = $filtered_results['blogname'];
	$blog_title = $filtered_results['blog_title'];
	$errors = $filtered_results['errors'];

	echo '<h2>' . sprintf( __( 'Get <em>another</em> %s site in seconds' ), get_network()->site_name ) . '</h2>';

	if ( $errors->get_error_code() ) {
		echo '<p>' . __( 'There was a problem, please correct the form below and try again.' ) . '</p>';
	}
	?>
	<p><?php printf( __( 'Welcome back, %s. By filling out the form below, you can <strong>add another site to your account</strong>. There is no limit to the number of sites you can have, so create to your heart&#8217;s content, but write responsibly!' ), $current_user->display_name ) ?></p>

	<?php
	$blogs = get_blogs_of_user($current_user->ID);
	if ( !empty($blogs) ) { ?>

			<p><?php _e( 'Sites you are already a member of:' ) ?></p>
			<ul>
				<?php foreach ( $blogs as $blog ) {
					$home_url = get_home_url( $blog->userblog_id );
					echo '<li><a href="' . esc_url( $home_url ) . '">' . $home_url . '</a></li>';
				} ?>
			</ul>
	<?php } ?>

	<p><?php _e( 'If you&#8217;re not going to use a great site domain, leave it for a new user. Now have at it!' ) ?></p>
	<form id="setupform" method="post" action="custom-register.php">
		<input type="hidden" name="stage" value="gimmeanotherblog" />
		<?php
		/**
		 * Hidden sign-up form fields output when creating another site or user.
		 *
		 * @since MU
		 *
		 * @param string $context A string describing the steps of the sign-up process. The value can be
		 *                        'create-another-site', 'validate-user', or 'validate-site'.
		 */
		do_action( 'signup_hidden_fields', 'create-another-site' );
		?>
		<?php show_blog_form($blogname, $blog_title, $errors); ?>
		<p class="submit"><input type="submit" name="submit" class="submit" value="<?php esc_attr_e( 'Create Site' ) ?>" /></p>
	</form>
	<?php
}
/**
 * Setup the new user signup process
 *
 * @since MU
 *
 * @param string          $user_name  The username.
 * @param string          $user_email The user's email.
 * @param WP_Error|string $errors     A WP_Error object containing existing errors. Defaults to empty string.
 */
function signup_user( $user_name = '', $user_email = '', $errors = '' ) {

	if ( !is_wp_error($errors) )
		$errors = new WP_Error();


	$signup_user_defaults = array(
		'user_name'  => $user_name,
		'user_email' => $user_email,
		'errors'     => $errors,
	);

	/**
	 * Filters the default user variables used on the user sign-up form.
	 *
	 * @since 3.0.0
	 *
	 * @param array $signup_user_defaults {
	 *     An array of default user variables.
	 *
	 *     @type string   $user_name  The user username.
	 *     @type string   $user_email The user email address.
	 *     @type WP_Error $errors     A WP_Error object with possible errors relevant to the sign-up user.
	 * }
	 */
	$filtered_results = apply_filters( 'signup_user_init', $signup_user_defaults );
	$user_name = $filtered_results['user_name'];
	$user_email = $filtered_results['user_email'];
	$errors = $filtered_results['errors'];

	?>

	<h2><?php
		/* translators: %s: name of the network */
		printf( __( 'Ange din studentmail för att skapa ett konto på ftek.' ));
	?></h2>
	<form id="setupform" method="post" action="custom-register.php" novalidate="novalidate">
		<input type="hidden" name="stage" value="validate-user-signup" />
		<?php
		/** This action is documented in custom-register.php */
		do_action( 'signup_hidden_fields', 'validate-user' );
		?>
		<?php show_user_form($user_name, $user_email, $errors); ?>

		<p>
                <input id="signupblog" type="hidden" name="signup_for" value="user" />
		</p>

		<p class="submit"><input type="submit" name="submit" class="submit" value="<?php esc_attr_e('Next') ?>" /></p>
	</form>
	<?php
}

/**
 * Validate the new user signup
 *
 * @since MU
 *
 * @return bool True if new user signup was validated, false if error
 */
function validate_user_signup() {
	$result = validate_user_form();
	$user_name = $result['user_name'];
	$user_email = $result['user_email'];
	$errors = $result['errors'];

// Check if email is student email using function check_email (further up)
apply_filters( 'registration_errors', $errors, $user_email );
// Get username (cid) from student email

list( $user_name, ) = explode( '@', $user_email, 2 );
$_POST['user_name'] = $user_name;

if ( $errors->get_error_code() ) {
		signup_user($user_name, $user_email, $errors);
		return false;
	}


	/** This filter is documented in custom-register.php */
	wpmu_signup_user( $user_name, $user_email, apply_filters( 'add_signup_meta', array() ) );

	confirm_user_signup($user_name, $user_email);
	return true;
}

/**
 * New user signup confirmation
 *
 * @since MU
 *
 * @param string $user_name The username
 * @param string $user_email The user's email address
 */
function confirm_user_signup($user_name, $user_email) {
	?>
	<h2><?php /* translators: %s: username */
	printf( __( '%s is your new username' ), $user_name) ?></h2>
	<p><?php _e( 'But, before you can start using your new username, <strong>you must activate it</strong>.' ) ?></p>
	<p><?php /* translators: %s: email address */
	printf( __( 'Check your inbox at %s and click the link given.' ), '<strong>' . $user_email . '</strong>' ); ?></p>
	<p><?php _e( 'If you do not activate your username within two days, you will have to sign up again.' ); ?></p>
	<?php
	/** This action is documented in custom-register.php */
	do_action( 'signup_finished' );
}


// these functions are needed but doesn't really handle the signup itself, if you are trying to figure out the login, look above.
/**
 * Retrieves languages available during the site/user signup process.
 *
 * @since 4.4.0
 *
 * @see get_available_languages()
 *
 * @return array List of available languages.
 */
function signup_get_available_languages() {
	/**
	 * Filters the list of available languages for front-end site signups.
	 *
	 * Passing an empty array to this hook will disable output of the setting on the
	 * signup form, and the default language will be used when creating the site.
	 *
	 * Languages not already installed will be stripped.
	 *
	 * @since 4.4.0
	 *
	 * @param array $available_languages Available languages.
	 */
	$languages = (array) apply_filters( 'signup_get_available_languages', get_available_languages() );

	/*
	 * Strip any non-installed languages and return.
	 *
	 * Re-call get_available_languages() here in case a language pack was installed
	 * in a callback hooked to the 'signup_get_available_languages' filter before this point.
	 */
	return array_intersect_assoc( $languages, get_available_languages() );
}

// Main
$active_signup = get_site_option( 'registration', 'none' );

/**
 * Filters the type of site sign-up.
 *
 * @since 3.0.0
 *
 * @param string $active_signup String that returns registration type. The value can be
 *                              'all', 'none', 'blog', or 'user'.
 */
$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );

// Make the signup type translatable.
$i18n_signup['all'] = _x('all', 'Multisite active signup type');
$i18n_signup['none'] = _x('none', 'Multisite active signup type');
$i18n_signup['blog'] = _x('blog', 'Multisite active signup type');
$i18n_signup['user'] = _x('user', 'Multisite active signup type');

if ( is_super_admin() ) {
	/* translators: 1: type of site sign-up; 2: network settings URL */
	echo '<div class="mu_alert">' . sprintf( __( 'Greetings Site Administrator! You are currently allowing &#8220;%s&#8221; registrations. To change or disable registration go to your <a href="%s">Options page</a>.' ), $i18n_signup[$active_signup], esc_url( network_admin_url( 'settings.php' ) ) ) . '</div>';
}

$newblogname = isset($_GET['new']) ? strtolower(preg_replace('/^-|-$|[^-a-zA-Z0-9]/', '', $_GET['new'])) : null;

$current_user = wp_get_current_user();
if ( $active_signup == 'none' ) {
	_e( 'Registration has been disabled.' );
} elseif ( $active_signup == 'blog' && !is_user_logged_in() ) {
	$login_url = wp_login_url( network_site_url( 'custom-register.php' ) );
	/* translators: %s: login URL */
	printf( __( 'You must first <a href="%s">log in</a>, and then you can create a new site.' ), $login_url );
} else {
	$stage = isset( $_POST['stage'] ) ?  $_POST['stage'] : 'default';
	switch ( $stage ) {
		case 'validate-user-signup' :
			if ( $active_signup == 'all' || $_POST[ 'signup_for' ] == 'blog' && $active_signup == 'blog' || $_POST[ 'signup_for' ] == 'user' && $active_signup == 'user' )
				validate_user_signup();
			else
				_e( 'User registration has been disabled.' );
		break;
		case 'validate-blog-signup':
			if ( $active_signup == 'all' || $active_signup == 'blog' )
				validate_blog_signup();
			else
				_e( 'Site registration has been disabled.' );
			break;
		case 'gimmeanotherblog':
			validate_another_blog_signup();
			break;
		case 'default':
		default :
			$user_email = isset( $_POST[ 'user_email' ] ) ? $_POST[ 'user_email' ] : '';
			/**
			 * Fires when the site sign-up form is sent.
			 *
			 * @since 3.0.0
			 */
			do_action( 'preprocess_signup_form' );
			if ( is_user_logged_in() && ( $active_signup == 'all' || $active_signup == 'blog' ) )
				signup_another_blog($newblogname);
			elseif ( ! is_user_logged_in() && ( $active_signup == 'all' || $active_signup == 'user' ) )
				signup_user( $newblogname, $user_email );
			elseif ( ! is_user_logged_in() && ( $active_signup == 'blog' ) )
				_e( 'Sorry, new registrations are not allowed at this time.' );
			else
				_e( 'You are logged in already. No need to register again!' );

			if ( $newblogname ) {
				$newblog = get_blogaddress_by_name( $newblogname );

				if ( $active_signup == 'blog' || $active_signup == 'all' )
					/* translators: %s: site address */
					printf( '<p><em>' . __( 'The site you were looking for, %s, does not exist, but you can create it now!' ) . '</em></p>',
						'<strong>' . $newblog . '</strong>'
					);
				else
					/* translators: %s: site address */
					printf( '<p><em>' . __( 'The site you were looking for, %s, does not exist.' ) . '</em></p>',
						'<strong>' . $newblog . '</strong>'
					);
			}
			break;
	}
}
?>
</div>
</div>
<?php
/**
 * Fires after the sign-up forms, before wp_footer.
 *
 * @since 3.0.0
 */
do_action( 'after_signup_form' ); ?>

<?php get_footer( 'custom-register' );
