<?php
/*
Plugin Name: Profile Staff
Plugin URI: http://www.greenboxindonesia.com/
Description: Management user profile, curriculum vitae post and detail contact staff
Version: 1.0
Author: Albert Sukmono
Author URI: http://www.albert.sukmono.web.id
License: GPLv2
*/

add_action( 'init', 'create_staff' );

function create_staff() {
register_post_type( 'staff',
array(
	'labels' => array(
	'name' => 'Staff',
	'singular_name' => 'Staff',
	'add_new' => 'Add New',
	'add_new_item' => 'Add Staff',
	'edit' => 'Edit',
	'edit_item' => 'Edit Staff',
	'new_item' => 'New Staff',
	'view' => 'View',
	'view_item' => 'View Staff',
	'search_items' => 'Search Staff',
	'not_found' => 'No Staff found',
	'not_found_in_trash' =>
	'No Staff found in Trash',
	'parent' => 'Parent Staff'
	),

	'public' => true,
	'publicly_queryable' => true,
	'rewrite' => array( 'slug' => 'staff','with_front' => false, 'hierarchical' => true),
	'show_ui' => true,
	'query_var' => true,
	'capability_type' => 'post',
	'menu_position' => 5,
	'supports' => array( 'title', 'editor', 'comments',	'thumbnail' ),
	'taxonomies' => array( 'staff_archive'),
	'register_meta_box_cb' => 'staff_meta_box',
	'menu_icon' => plugins_url( 'images/favicon.png', __FILE__ ),
	'has_archive' => true	
)
);
flush_rewrite_rules();
}

/*
 * create taxonomy
 */
// hook into the init action and call create_staff_taxonomies when it fires
add_action( 'init', 'staff_taxonomies', 0 );
// create for the post type "staff"
function staff_taxonomies() {
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' 			=> array( 'slug' => 'staff_archive', 'with_front' => true ),
		'has_archive' 		=> true
    );

    register_taxonomy( 'staff_categories', array( 'staff' ), $args );
}

/*
 * create metabox
 */
add_action( 'admin_init', 'staff_admin' );

function staff_admin() {
add_meta_box( 
	'staff_meta_box',
	'Staff Details',
	'display_staff_meta_box',
	'staff', 'normal', 'high' 
	);
}

function display_staff_meta_box( $staff ) {
// metabox list ID on post
$nama = esc_html( get_post_meta( $staff->ID, 'nama', true ) );
$tahun_jabatan = esc_html( get_post_meta( $staff->ID, 'tahun_jabatan', true ) );
$universitas = esc_html( get_post_meta( $staff->ID, 'universitas', true ) );
$jurusan = esc_html( get_post_meta( $staff->ID, 'jurusan', true ) );
$angkatan = esc_html( get_post_meta( $staff->ID, 'angkatan', true ) );
$komisariat = esc_html( get_post_meta( $staff->ID, 'komisariat', true ) );
$kota_asal = esc_html( get_post_meta( $staff->ID, 'kota_asal', true ) );
$alamat_sekarang = esc_html( get_post_meta( $staff->ID, 'alamat_sekarang', true ) );
$kontak = esc_html( get_post_meta( $staff->ID, 'kontak', true ) );
$email = esc_html( get_post_meta( $staff->ID, 'email', true ) );
$facebook = esc_html( get_post_meta( $staff->ID, 'facebook', true ) );
$twitter = esc_html( get_post_meta( $staff->ID, 'twitter', true ) );
$website = esc_html( get_post_meta( $staff->ID, 'website', true ) );

$user_rating = intval( get_post_meta( $staff->ID, 'user_rating', true ) );
?>
<table>
	<tr>
	<td style="width: 100%">Nama Lengkap</td>
	<td><input type="text" size="80" name="staff_nama" value="<?php echo $nama; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Tahun Jabatan/Periode</td>
	<td><input type="text" size="80" name="staff_tahun_jabatan" value="<?php echo $tahun_jabatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Universitas</td>
	<td><input type="text" size="80" name="staff_universitas" value="<?php echo $universitas; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Jurusan</td>
	<td><input type="text" size="80" name="staff_jurusan" value="<?php echo $jurusan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Angkatan Mahasiswa</td>
	<td><input type="text" size="80" name="staff_angkatan" value="<?php echo $angkatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Asal Komisariat</td>
	<td><input type="text" size="80" name="staff_komisariat" value="<?php echo $komisariat; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Kota Asal</td>
	<td><input type="text" size="80" name="staff_kota_asal" value="<?php echo $kota_asal; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Alamat Sakarang</td>
	<td><input type="text" size="80" name="staff_alamat_sekarang" value="<?php echo $alamat_sekarang; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Kontak/ HP</td>
	<td><input type="text" size="80" name="staff_kontak" value="<?php echo $kontak; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Email</td>
	<td><input type="text" size="80" name="staff_email" value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Facebook</td>
	<td><input type="text" size="80" name="staff_facebook" value="<?php echo $facebook; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Twitter</td>
	<td><input type="text" size="80" name="staff_twitter" value="<?php echo $twitter; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Website</td>
	<td><input type="text" size="80" name="staff_website" value="<?php echo $website; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 150px">Rating</td>
		<td>
			<select style="width: 100px" name="staff_rating">
				<?php
				// Generate all items of drop-down list
				for ( $rating = 5; $rating >= 1; $rating -- ) {
				?>
				<option value="<?php echo $rating; ?>"
				<?php echo selected( $rating,
				$user_rating ); ?>>
				<?php echo $rating; ?> stars
				<?php } ?>
			</select>
		</td>
	</tr>
</table>
<?php }

add_action( 'save_post',
'add_staff_fields', 10, 2 );

function add_staff_fields( $staff_id,
$staff ) {
// Check post type for User Profile
if ( $staff->post_type == 'staff' ) {
// Store data in post meta table if present in post data

if ( isset( $_POST['staff_nama'] ) &&
$_POST['staff_nama'] != '' ) {
update_post_meta( $staff_id, 'nama',
$_POST['staff_nama'] );
}// Field nama lengkap
if ( isset( $_POST['staff_tahun_jabatan'] ) &&
$_POST['staff_tahun_jabatan'] != '' ) {
update_post_meta( $staff_id, 'tahun_jabatan',
$_POST['staff_tahun_jabatan'] );
}// Field tahun jabatan/ periode jabatan
if ( isset( $_POST['staff_universitas'] ) &&
$_POST['staff_universitas'] != '' ) {
update_post_meta( $staff_id, 'universitas',
$_POST['staff_universitas'] );
}// Field universitas
if ( isset( $_POST['staff_jurusan'] ) &&
$_POST['staff_jurusan'] != '' ) {
update_post_meta( $staff_id, 'jurusan',
$_POST['staff_jurusan'] );
}// Field jurusan
if ( isset( $_POST['staff_angkatan'] ) &&
$_POST['staff_angkatan'] != '' ) {
update_post_meta( $staff_id, 'angkatan',
$_POST['staff_angkatan'] );
}// Field angkatan
if ( isset( $_POST['staff_komisariat'] ) &&
$_POST['staff_komisariat'] != '' ) {
update_post_meta( $staff_id, 'komisariat',
$_POST['staff_komisariat'] );
}// Field komisariat
if ( isset( $_POST['staff_kota_asal'] ) &&
$_POST['staff_kota_asal'] != '' ) {
update_post_meta( $staff_id, 'kota_asal',
$_POST['staff_kota_asal'] );
}// Field kota asal
if ( isset( $_POST['staff_alamat_sekarang'] ) &&
$_POST['staff_alamat_sekarang'] != '' ) {
update_post_meta( $staff_id, 'alamat_sekarang',
$_POST['staff_alamat_sekarang'] );
}// Field alamat sekarang
if ( isset( $_POST['staff_kontak'] ) &&
$_POST['staff_kontak'] != '' ) {
update_post_meta( $staff_id, 'kontak',
$_POST['staff_kontak'] );
}// Field kontak
if ( isset( $_POST['staff_email'] ) &&
$_POST['staff_email'] != '' ) {
update_post_meta( $staff_id, 'email',
$_POST['staff_email'] );
}// Field email
if ( isset( $_POST['staff_facebook'] ) &&
$_POST['staff_facebook'] != '' ) {
update_post_meta( $staff_id, 'facebook',
$_POST['staff_facebook'] );
}// Field email
if ( isset( $_POST['staff_twitter'] ) &&
$_POST['staff_twitter'] != '' ) {
update_post_meta( $staff_id, 'twitter',
$_POST['staff_email'] );
}// Field email
if ( isset( $_POST['staff_website'] ) &&
$_POST['staff_website'] != '' ) {
update_post_meta( $staff_id, 'website',
$_POST['staff_website'] );
}// Field website

if ( isset( $_POST['staff_rating'] ) &&
$_POST['staff_rating'] != '' ) {
update_post_meta( $staff_id, 'user_rating',
$_POST['staff_rating'] );
}
}
}

add_filter( 'template_include',
'masuk_template_function', 1 );

// Load Template from themes
function masuk_template_function( $template_path ) {
if ( get_post_type() == 'staff' ) {
if ( is_single() ) {
// checks if the file exists in the theme first,
// otherwise serve the file from the plugin
if ( $theme_file = locate_template( array
( 'single-staff.php' ) ) ) {
$template_path = $theme_file;
} else {
$template_path = plugin_dir_path( __FILE__ ) .
'/single-staff.php';
}
}
if ( is_archive() ) {
// checks if the file exists in the theme first,
// otherwise serve the file from the plugin
if ( $theme_file = locate_template( array
( 'archive-staff.php' ) ) ) {
$template_path = $theme_file;
} else {
$template_path = plugin_dir_path( __FILE__ ) .
'/archive-staff.php';
}
}
}
return $template_path;
}

?>
