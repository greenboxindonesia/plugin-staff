<?php
/*
Plugin Name: Profile Pengurus
Plugin URI: http://www.greenboxindonesia.com/
Description: Management user profile, curriculum vitae post and detail contact
Version: 1.0
Author: Albert Sukmono
Author URI: http://www.albert.sukmono.web.id
License: GPLv2
*/

add_action( 'init', 'create_profile_pengurus' );

function create_profile_pengurus() {
register_post_type( 'profile_pengurus',
array(
'labels' => array(
'name' => 'Pengurus',
'singular_name' => 'Pengurus',
'add_new' => 'Add New',
'add_new_item' => 'Add Pengurus',
'edit' => 'Edit',
'edit_item' => 'Edit Pengurus',
'new_item' => 'New Pengurus',
'view' => 'View',
'view_item' => 'View Pengurus',
'search_items' => 'Search Pengurus',
'not_found' => 'No Pengurus found',
'not_found_in_trash' =>
'No Pengurus found in Trash',
'parent' => 'Parent Pengurus'
),
'public' => true,
'publicly_queryable' => true,
'rewrite' => true,
'query_var' => true,
'capability_type' => 'post',
'menu_position' => 15,
'supports' =>
array( 'title', 'editor', 'comments',
'thumbnail',  ),
'taxonomies' => array( 'category', 'post_tag' ),
'menu_icon' =>
plugins_url( 'images/pengurus.png', __FILE__ ),
'has_archive' => true
)
);
}

add_action( 'admin_init', 'my_admin' );

function my_admin() {
add_meta_box( 'profile_pengurus_meta_box',
'Pengurus Details',
'display_profile_pengurus_meta_box',
'profile_pengurus', 'normal', 'high' );
}

function display_profile_pengurus_meta_box( $profile_pengurus ) {
// Retrieve current name of the Director and Movie Rating based on review ID
$nama = esc_html( get_post_meta( $profile_pengurus->ID, 'nama', true ) );
$tahun_jabatan = esc_html( get_post_meta( $profile_pengurus->ID, 'tahun_jabatan', true ) );
$universitas = esc_html( get_post_meta( $profile_pengurus->ID, 'universitas', true ) );
$jurusan = esc_html( get_post_meta( $profile_pengurus->ID, 'jurusan', true ) );
$angkatan = esc_html( get_post_meta( $profile_pengurus->ID, 'angkatan', true ) );
$komisariat = esc_html( get_post_meta( $profile_pengurus->ID, 'komisariat', true ) );
$kota_asal = esc_html( get_post_meta( $profile_pengurus->ID, 'kota_asal', true ) );
$alamat_sekarang = esc_html( get_post_meta( $profile_pengurus->ID, 'alamat_sekarang', true ) );
$kontak = esc_html( get_post_meta( $profile_pengurus->ID, 'kontak', true ) );
$email = esc_html( get_post_meta( $profile_pengurus->ID, 'email', true ) );
$facebook = esc_html( get_post_meta( $profile_pengurus->ID, 'facebook', true ) );
$twitter = esc_html( get_post_meta( $profile_pengurus->ID, 'twitter', true ) );
$website = esc_html( get_post_meta( $profile_pengurus->ID, 'website', true ) );

$user_rating = intval( get_post_meta( $profile_pengurus->ID, 'user_rating', true ) );
?>
<table>
	<tr>
	<td style="width: 100%">Nama Lengkap</td>
	<td><input type="text" size="80" name="profile_pengurus_nama" value="<?php echo $nama; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Tahun Jabatan/Periode</td>
	<td><input type="text" size="80" name="profile_pengurus_tahun_jabatan" value="<?php echo $tahun_jabatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Universitas</td>
	<td><input type="text" size="80" name="profile_pengurus_universitas" value="<?php echo $universitas; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Jurusan</td>
	<td><input type="text" size="80" name="profile_pengurus_jurusan" value="<?php echo $jurusan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Angkatan Mahasiswa</td>
	<td><input type="text" size="80" name="profile_pengurus_angkatan" value="<?php echo $angkatan; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Asal Komisariat</td>
	<td><input type="text" size="80" name="profile_pengurus_komisariat" value="<?php echo $komisariat; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Kota Asal</td>
	<td><input type="text" size="80" name="profile_pengurus_kota_asal" value="<?php echo $kota_asal; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Alamat Sakarang</td>
	<td><input type="text" size="80" name="profile_pengurus_alamat_sekarang" value="<?php echo $alamat_sekarang; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Kontak/ HP</td>
	<td><input type="text" size="80" name="profile_pengurus_kontak" value="<?php echo $kontak; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Email</td>
	<td><input type="text" size="80" name="profile_pengurus_email" value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Facebook</td>
	<td><input type="text" size="80" name="profile_pengurus_facebook" value="<?php echo $facebook; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Twitter</td>
	<td><input type="text" size="80" name="profile_pengurus_twitter" value="<?php echo $twitter; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100%">Website</td>
	<td><input type="text" size="80" name="profile_pengurus_website" value="<?php echo $website; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 150px">Rating</td>
		<td>
			<select style="width: 100px" name="profile_pengurus_rating">
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
'add_profile_pengurus_fields', 10, 2 );

function add_profile_pengurus_fields( $profile_pengurus_id,
$profile_pengurus ) {
// Check post type for User Profile
if ( $profile_pengurus->post_type == 'profile_pengurus' ) {
// Store data in post meta table if present in post data

if ( isset( $_POST['profile_pengurus_nama'] ) &&
$_POST['profile_pengurus_nama'] != '' ) {
update_post_meta( $profile_pengurus_id, 'nama',
$_POST['profile_pengurus_nama'] );
}// Field nama lengkap
if ( isset( $_POST['profile_pengurus_tahun_jabatan'] ) &&
$_POST['profile_pengurus_tahun_jabatan'] != '' ) {
update_post_meta( $profile_pengurus_id, 'tahun_jabatan',
$_POST['profile_pengurus_tahun_jabatan'] );
}// Field tahun jabatan/ periode jabatan
if ( isset( $_POST['profile_pengurus_universitas'] ) &&
$_POST['profile_pengurus_universitas'] != '' ) {
update_post_meta( $profile_pengurus_id, 'universitas',
$_POST['profile_pengurus_universitas'] );
}// Field universitas
if ( isset( $_POST['profile_pengurus_jurusan'] ) &&
$_POST['profile_pengurus_jurusan'] != '' ) {
update_post_meta( $profile_pengurus_id, 'jurusan',
$_POST['profile_pengurus_jurusan'] );
}// Field jurusan
if ( isset( $_POST['profile_pengurus_angkatan'] ) &&
$_POST['profile_pengurus_angkatan'] != '' ) {
update_post_meta( $profile_pengurus_id, 'angkatan',
$_POST['profile_pengurus_angkatan'] );
}// Field angkatan
if ( isset( $_POST['profile_pengurus_komisariat'] ) &&
$_POST['profile_pengurus_komisariat'] != '' ) {
update_post_meta( $profile_pengurus_id, 'komisariat',
$_POST['profile_pengurus_komisariat'] );
}// Field komisariat
if ( isset( $_POST['profile_pengurus_kota_asal'] ) &&
$_POST['profile_pengurus_kota_asal'] != '' ) {
update_post_meta( $profile_pengurus_id, 'kota_asal',
$_POST['profile_pengurus_kota_asal'] );
}// Field kota asal
if ( isset( $_POST['profile_pengurus_alamat_sekarang'] ) &&
$_POST['profile_pengurus_alamat_sekarang'] != '' ) {
update_post_meta( $profile_pengurus_id, 'alamat_sekarang',
$_POST['profile_pengurus_alamat_sekarang'] );
}// Field alamat sekarang
if ( isset( $_POST['profile_pengurus_kontak'] ) &&
$_POST['profile_pengurus_kontak'] != '' ) {
update_post_meta( $profile_pengurus_id, 'kontak',
$_POST['profile_pengurus_kontak'] );
}// Field kontak
if ( isset( $_POST['profile_pengurus_email'] ) &&
$_POST['profile_pengurus_email'] != '' ) {
update_post_meta( $profile_pengurus_id, 'email',
$_POST['profile_pengurus_email'] );
}// Field email
if ( isset( $_POST['profile_pengurus_facebook'] ) &&
$_POST['profile_pengurus_facebook'] != '' ) {
update_post_meta( $profile_pengurus_id, 'facebook',
$_POST['profile_pengurus_facebook'] );
}// Field email
if ( isset( $_POST['profile_pengurus_twitter'] ) &&
$_POST['profile_pengurus_twitter'] != '' ) {
update_post_meta( $profile_pengurus_id, 'twitter',
$_POST['profile_pengurus_email'] );
}// Field email
if ( isset( $_POST['profile_pengurus_website'] ) &&
$_POST['profile_pengurus_website'] != '' ) {
update_post_meta( $profile_pengurus_id, 'website',
$_POST['profile_pengurus_website'] );
}// Field website

if ( isset( $_POST['profile_pengurus_rating'] ) &&
$_POST['profile_pengurus_rating'] != '' ) {
update_post_meta( $profile_pengurus_id, 'user_rating',
$_POST['profile_pengurus_rating'] );
}
}
}

add_filter( 'template_include',
'include_template_function', 1 );

// Load Template from themes
function include_template_function( $template_path ) {
if ( get_post_type() == 'profile_pengurus' ) {
if ( is_single() ) {
// checks if the file exists in the theme first,
// otherwise serve the file from the plugin
if ( $theme_file = locate_template( array
( 'single-profile.php' ) ) ) {
$template_path = $theme_file;
} else {
$template_path = plugin_dir_path( __FILE__ ) .
'/single-profile.php';
}
}
if ( is_archive() ) {
// checks if the file exists in the theme first,
// otherwise serve the file from the plugin
if ( $theme_file = locate_template( array
( 'archive-profile.php' ) ) ) {
$template_path = $theme_file;
} else {
$template_path = plugin_dir_path( __FILE__ ) .
'/archive-profile.php';
}
}
}
return $template_path;
}

?>
