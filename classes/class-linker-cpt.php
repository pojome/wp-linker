<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Linker_CPT {
	
	public $slug = 'linker';

	public function register_post_type() {
		if ( apply_filters( 'linker_skip_register_post_type', false ) ) {
			return;
		}
		
		$labels = array(
			'name'               => __( 'Linker', 'linker' ),
			'singular_name'      => __( 'Link', 'linker' ),
			'add_new'            => __( 'Add New', 'linker' ),
			'add_new_item'       => __( 'Add New Link', 'linker' ),
			'edit'               => __( 'Edit', 'linker' ),
			'edit_item'          => __( 'Edit Link', 'linker' ),
			'new_item'           => __( 'New Link', 'linker' ),
			'view'               => __( 'View Link', 'linker' ),
			'view_item'          => __( 'View Link', 'linker' ),
			'search_items'       => __( 'Search Link', 'linker' ),
			'not_found'          => __( 'No Links found', 'linker' ),
			'not_found_in_trash' => __( 'No Links found in Trash', 'linker' ),
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'exclude_from_search' => true,
			'menu_position' => 30,
			'supports' => array( 'title', 'author' ),
			'rewrite' => array(
				'slug' => apply_filters( 'linker_prefix_slug', 'go' ),
				'with_front' => false,
			),
		);
		
		register_post_type( $this->slug,
			apply_filters( 'linker_register_post_type_args', $args )
		);
	}

	public function post_updated_messages( $messages ) {
		global $post;

		$messages[ $this->slug ] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => __( 'Link updated.', 'linker' ),
			2 => __( 'Custom field updated.', 'linker' ),
			3 => __( 'Custom field deleted.', 'linker' ),
			4 => __( 'Link updated.', 'linker' ),
			/* translators: %s: date and time of the revision */
			5 => isset( $_GET['revision'] ) ? sprintf( __( 'Link restored to revision from %s', 'linker' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Link published.', 'linker' ),
			7 => __( 'Link saved.', 'linker' ),
			8 => __( 'Link submitted.', 'linker' ),
			9 => sprintf( __( 'Post scheduled for: <strong>%1$s</strong>.', 'linker' ),
				// translators: Publish box date format, see http://php.net/date
				date_i18n( __( 'M j, Y @ G:i', 'linker' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Link draft updated.', 'linker' ),
		);

		return $messages;
	}

	public function plugin_action_links( $links ) {
		$settings_link = sprintf( '<a href="%s" target="_blank">%s</a>', 'https://github.com/KingYes/wp-linker', __( 'GitHub', 'linker' ) );
		array_unshift( $links, $settings_link );

		return $links;
	}

	public function admin_cpt_columns( $columns ) {
		return array(
			'cb'               => '<input type="checkbox" />',
			'title'            => __( 'Title', 'linker' ),
			'linker_url'       => __( 'Redirect to', 'linker' ),
			'linker_permalink' => __( 'Permalink', 'linker' ),
			'linker_clicks'    => __( 'Clicks', 'linker' ),
			'author'           => __( 'Author', 'linker' ),
			'date'             => __( 'Date', 'linker' ),
		);
	}

	public function custom_columns( $column ) {
		global $post;

		switch ( $column ) {
			case 'linker_url' :
				echo make_clickable( esc_url( get_post_meta( $post->ID, '_linker_redirect', true ) ) );
				break;
			
			case 'linker_permalink' :
				echo '<input type="text" class="linker-permalink-copy-paste" value="' . esc_attr( get_permalink( $post->ID ) ) . '" readonly />';
				break;
			
			case 'linker_clicks' :
				echo number_format_i18n( absint( get_post_meta( $post->ID, '_linker_count', true ) ) );
				break;
		}
	}

	public function register_meta_box() {
		add_meta_box(
			'linker-url-information',
			__( 'Link Info', 'linker' ),
			array( &$this, 'render_meta_box' ),
			$this->slug,
			'normal',
			'high'
		);
	}

	public function render_meta_box( $post ) {
		wp_nonce_field( basename( __FILE__ ), '_linker_meta_box_nonce' );
		
		$field_id = '_linker_redirect';
		echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="url" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
			'{label}' => __( 'Redirect Link:', 'linker' ),
			'{name}'  => $field_id,
			'{placeholder}' => __( 'https://your-link.com/', 'linker' ),
			'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
		) );

		$options = array(
			'' => __( 'Don\'t forward', 'linker' ),
			'add_n_override' => __( 'Forward & Override', 'linker' ),
			'add_only' => __( 'Forward Without Overriding', 'linker' ),
		);

		$field_id = '_linker_query_params';

		$query_params_selected = get_post_meta( $post->ID, $field_id, true );

		$options_html = '';
		foreach ( $options as $key => $label ) {
			$options_html .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $query_params_selected, $key, false ), $label );
		}

		$description = '<ul>';
		$description .= '<li>';
		$description .= __( "<strong>Don't forward -</strong> Do not include URL parameters from the referrer when redirecting.", 'linker' );
		$description .= '</li><li>';
		$description .= __( '<strong>Forward & Override -</strong> Forward URL parameters while replacing existing ones in the destination URL in case of conflict.', 'linker' );
		$description .= '</li><li>';
		$description .= __( '<strong>Forward Without Overriding -</strong> Include new URL parameters without modifying those already present in the destination URL.', 'linker' );
		$description .= '</li>';
		$description .= '</ul>';

		echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><select id="{name}" name="{name}" class="large-text">{options_html}</select></p><p class="description">{description}</p>', array(
			'{label}' => __( 'Forward URL Parameters:', 'linker' ),
			'{name}'  => $field_id,
			'{options_html}' => $options_html,
			'{description}' => $description,
		) );

		$counter = absint( get_post_meta( $post->ID, '_linker_count', true ) );
		printf( '<p class="description">' . __( 'This Link has been accessed <strong>%d</strong> times.', 'linker' ) . '</p>', $counter );
	}

	public function save_post( $post_id ) {
		if ( ! isset( $_POST['_linker_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['_linker_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
			return;
		}
		
		if ( isset( $_POST['_linker_redirect'] ) ) {
			update_post_meta( $post_id, '_linker_redirect', $_POST['_linker_redirect'] );
		} else {
			delete_post_meta( $post_id, '_linker_redirect' );
		}

		if ( ! empty( $_POST['_linker_query_params'] ) ) {
			update_post_meta( $post_id, '_linker_query_params', $_POST['_linker_query_params'] );
		} else {
			delete_post_meta( $post_id, '_linker_query_params' );
		}
	}

	public function count_and_redirect() {
		if ( ! is_singular( $this->slug ) ) {
			return;
		}

		$counter = absint( get_post_meta( get_the_ID(), '_linker_count', true ) );
		update_post_meta( get_the_ID(), '_linker_count', ++$counter );

		$redirect_url = esc_url_raw( get_post_meta( get_the_ID(), '_linker_redirect', true ) );

		$query_params = get_post_meta( get_the_ID(), '_linker_query_params', true );

		if ( ! empty( $query_params ) && ! empty( $_GET ) ) {
			$url_parse = wp_parse_url( $redirect_url, PHP_URL_QUERY );
			parse_str( $url_parse, $redirect_query_params );

			$query = array();
			if ( 'add_n_override' === $query_params ) {
				$query = array_merge( $redirect_query_params, $_GET );
			} elseif ( 'add_only' === $query_params ) {
				$query = array_merge( $_GET, $redirect_query_params );
			}

			$redirect_url = add_query_arg( $query, $redirect_url );
		}

		if ( ! empty( $redirect_url ) ) {
			wp_redirect( $redirect_url, 301 );
		} else {
			wp_redirect( home_url(), 302 );
		}

		die();
	}

	/**
	 * Add Dashboard Widget for Linker
	 */
	public function linker_add_dashboard_widget() {
		wp_add_dashboard_widget(
			'linker_dashboard_widget',
			__( 'Linker - Top 10', 'linker' ),
			array( &$this, 'linker_dashboard_widget_function' )
		);
	}

	/**
	 * Add Dashboard Function for Linker
	 */
	public function linker_dashboard_widget_function() {
		$posts = get_posts(
			array(
				'post_type' => $this->slug,
				'post_status' => 'publish',
				'fields' => 'ids',
				'meta_key' => '_linker_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'posts_per_page' => 10,
			)
		);
		
		if ( empty( $posts ) ) {
			echo '<p>' . __( 'There are no stats available yet!', 'linker' ) . '</p>';
			return;
		}
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead>
			<tr align="<?php echo is_rtl() ? 'right' : 'left'; ?>">
				<th scope="col"><?php _e( 'Redirect to', 'linker' ); ?></th>
				<th scope="col"><?php _e( 'Edit', 'linker' ); ?></th>
				<th scope="col"><?php _e( 'Clicks', 'linker' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			//loop over each post
			foreach ( $posts as $post_id ) :
				// Get the meta you need from each post
				$link       = get_post_meta( $post_id, '_linker_redirect', true );
				$link_count = absint( get_post_meta( $post_id, '_linker_count', true ) );
				?>
				<tr>
					<td><a target="_blank" href="<?php echo esc_attr( $link ); ?>"><?php echo esc_url( $link ); ?></a></td>
					<td><a href="<?php echo get_edit_post_link( $post_id ); ?>"><?php _e( 'Edit', 'linker' ); ?></a></td>
					<td><?php echo esc_html( $link_count ); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Add order by Clicks
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	public function sortable_linker_clicks_column( $columns ) {
		$columns['linker_clicks'] = 'linker_clicks';

		return $columns;
	}

	/**
	 * Add order by Clicks
	 *
	 * @param WP_Query $query
	 */
	public function clicks_orderby( $query ) {
		if ( ! is_admin() ) {
			return;
		}

		$orderby = $query->get( 'orderby' );

		if ( 'linker_clicks' == $orderby ) {
			$query->set( 'meta_key', '_linker_count' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}

	/**
	 * Add filter by Author
	 */
	public function linker_filter_by_author() {
		global $typenow;
		
		if ( ! $this->slug === $typenow ) {
			return;
		}

		wp_dropdown_users(
			array(
				'name' => 'author',
				'show_option_all' => __( 'View all authors', 'linker' ),
			)
		);
	}

	/**
	 * Add external CSS Stylesheet file
	 *
	 * @param $hook
	 */
	public function dashboard_widget_linker_external_css( $hook ) {
		global $typenow;
		
		$include_style = false;
		if ( 'index.php' === $hook ) {
			$include_style = true;
		}
		
		if ( 'edit.php' === $hook && $this->slug === $typenow ) {
			$include_style = true;
		}
		
		if ( ! $include_style ) {
			return;
		}
		
		wp_enqueue_style( 'linker-dashboard-widget-styles', LINKER_PLUGIN_URL . '/assets/css/styles.css' );
	}
	
	public function __construct() {
		$this->slug = apply_filters( 'linker_post_type_slug', $this->slug );

		add_action( 'init', array( &$this, 'register_post_type' ) );
		add_filter( 'post_updated_messages', array( &$this, 'post_updated_messages' ) );
		
		add_action( 'admin_menu', array( &$this, 'register_meta_box' ) );
		add_filter( 'plugin_action_links_' . LINKER_BASE, array( &$this, 'plugin_action_links' ) );

		add_filter( "manage_edit-{$this->slug}_columns", array( &$this, 'admin_cpt_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
		add_action( 'save_post', array( &$this, 'save_post' ) );
		add_action( 'template_redirect', array( &$this, 'count_and_redirect' ) );

		// Add Dashboard Widget for Linker
		add_action( 'wp_dashboard_setup', array( &$this, 'linker_add_dashboard_widget' ) );

		// Add order by Clicks
		add_action( 'pre_get_posts', array( &$this, 'clicks_orderby' ) );
		add_filter( "manage_edit-{$this->slug}_sortable_columns", array( &$this, 'sortable_linker_clicks_column' ) );

		// Add filter by Author
		add_action( 'restrict_manage_posts', array( &$this, 'linker_filter_by_author' ) );

		// Add external CSS Stylesheet file
		add_action( 'admin_enqueue_scripts', array( &$this, 'dashboard_widget_linker_external_css' ) );
	}
}
