<?php
defined( 'ABSPATH' ) || exit;
$section = sanitize_text_field( wp_unslash( $_GET['section'] ?? 'This page' ) );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( $section ); ?> | Coming Soon</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'ub-coming-soon' ); ?>>
	<main style="min-height:100svh;display:grid;place-items:center;padding:28px;background:#e0eed0;color:#006831;text-align:center">
		<div style="max-width:760px">
			<p style="font:900 14px/1.2 sans-serif;letter-spacing:.14em;text-transform:uppercase">Fresh page in progress</p>
			<h1 style="margin:.2em 0;font:900 clamp(52px,10vw,120px)/.88 sans-serif;text-transform:uppercase"><?php echo esc_html( $section ); ?><br>Coming soon.</h1>
			<p style="font:400 20px/1.5 sans-serif">We are rolling this page fresh for the staging preview.</p>
			<a href="<?php echo esc_url( home_url( '/new-home/' ) ); ?>" style="display:inline-block;margin-top:20px;padding:16px 24px;border-radius:99px;color:#fff;background:#006831;font:900 14px/1 sans-serif;text-decoration:none;text-transform:uppercase">Back to New Home</a>
		</div>
	</main>
	<?php wp_footer(); ?>
</body>
</html>
