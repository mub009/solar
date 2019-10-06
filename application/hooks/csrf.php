<?php
/**
 * CSRF Protection Class
 */
class CSRF_Protection
{
    /**
     * Holds CI instance
     *
     * @var CI instance
     */
    private $CI;

    /**
     * Stores the token
     *
     * @var string
     */
    private static $token;

    // -----------------------------------------------------------------------------------

    public function inject_tokens()
    {
        $this->CI = &get_instance();

        if (!$this->CI->config->item('linkigniter.enable_csrf_protection')) {
            // This has to be here otherwise nothing is sent to the browser
            $this->CI->output->_display($this->CI->output->get_output());
            return;
        }

        $output = $this->CI->output->get_output();

        // Inject into form
        $output = preg_replace(
            '/(<(form|FORM)[^>]*(method|METHOD)="(post|POST)"[^>]*>)/',
            ' <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />',
            $output
        );

        // Inject into <head>
        $output = preg_replace(
            '/(<\/head>)/',
            ' <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />',
            $output
        );

        $this->CI->output->_display($output);
    }

}
