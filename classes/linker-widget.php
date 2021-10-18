<?php

class Linker_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'linker_widget',
            esc_html__( 'Linker', 'linker' ),
            array( 'description' => esc_html__( 'Linker widget', 'linker' ), )
        );
    }


    private function translate(){
        /* Translate string not includes in script */
        __('Title:', 'linker');
        __('order by', 'linker');
        __('ASC', 'linker');
        __('DESC', 'linker');
        __('thumbnail', 'linker');

    }

    private $widget_fields = array(
        array(
            'label' => 'order by',
            'default' => 'ASC',
            'id' => 'order',
            'type' => 'select',
            'options' => array(
                'ASC',
                'DESC',
            ),
        ),
        array(
            'label' => 'thumbnail',
            'default' => 'true',
            'id' => 'thumbnail',
            'type' => 'checkbox',
        )
    );

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        $title = $instance['title'] ? $instance['title'] : __('Linker', 'linker');
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }

        $linker_query_args = array(
            'post_type' => 'linker',
            'orderby'   => 'menu_order',
            'order'     => $instance['order']
        );

        query_posts( $linker_query_args );

        while ( have_posts() ) : the_post();
            global $post;

            if ( intval($instance['thumbnail']) === 1 )
            {
                echo strtr ('<a {target} title="{text}" class="linker-thumbnail" href="{permalink}" >{thumbnail}</a>',
                    array (
                        '{thumbnail}' => get_the_post_thumbnail($post->ID, "thumbnail"),
                        '{text}'      => get_the_title(),
                        '{permalink}' => get_the_permalink(),
                        '{order}'     => $post->menu_order,
                        '{target}'    => (get_post_meta($post->ID, '_linker_target', 'true') ) ? 'target="_new"' : null
                    ));
            }
            else
            {
                echo strtr ('<a {target} href="{permalink}" class="linker_url"><img src="{thumbnail}" class="linker-thumbnail-icon">{text}</a>',
                    array (
                        '{thumbnail}' => has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID, "thumbnail") : plugin_dir_url(dirname(__FILE__)).'assets/images/default.png',
                        '{text}'      => get_the_title(),
                        '{permalink}' => get_the_permalink(),
                        '{order}'     => $post->menu_order,
                        '{target}'    => (get_post_meta($post->ID, '_linker_target', 'true') ) ? 'target="_new"' : null
                    ));
            }
        endwhile;
        echo $args['after_widget'];
    }

    public function field_generator( $instance ) {
        $output = '';
        foreach ( $this->widget_fields as $widget_field ) {
            $default = '';
            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'linker' );
            switch ( $widget_field['type'] ) {
                case 'checkbox':
                    $output .= '<p>';
                    $output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr__( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr__( $widget_field['label'], 'linker' ).'</label>';
                    $output .= '</p>';
                    break;

                case 'select':
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr__( $widget_field['label'], 'linker' ).':</label> ';
                    $output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
                    foreach ($widget_field['options'] as $option) {
                        if ($widget_value == $option) {
                            $output .= '<option value="'.$option.'" selected>'.__($option, 'linker').'</option>';
                        } else {
                            $output .= '<option value="'.$option.'">'.__($option, 'linker').'</option>';
                        }
                    }
                    $output .= '</select>';
                    $output .= '</p>';
                    break;

                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr__( $widget_field['label'], 'linker' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }



    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'linker' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'linker' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php

        $this->field_generator( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
}

function register_linker_widget() {
    register_widget( 'Linker_Widget' );
}
add_action( 'widgets_init', 'register_linker_widget' );


function linker_external_css()
{
    wp_enqueue_style('linker-front-styles', LINKER_PLUGIN_URL . '/assets/css/front-style.css');
}
add_action( 'wp_enqueue_scripts', 'linker_external_css');
