<?php
/**
* @package Helix3 Framework
* @author JoomShaper https://www.joomshaper.com
* @copyright (c) 2010 - 2021 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

jimport('joomla.plugin.plugin');
jimport( 'joomla.event.plugin' );
jimport('joomla.registry.registry');

use Joomla\CMS\HTML\HTMLHelper;

if(!class_exists('Helix3')) {
  require_once (__DIR__ . '/core/helix3.php');
}

class  plgSystemHelix3 extends JPlugin
{

    protected $autoloadLanguage = true;

    protected $app;

    /**
	 * Handle the event hook onAfterInitialize.
	 * Here we can override the HTML functions.
	 *
	 * @return	void
	 * @since	2.0.0
	 */
	public function onAfterInitialise()
	{
		$template = $this->getTemplateName();

		if (isset($template) && !empty($template))
		{
			$bootstrapPath = JPATH_ROOT . '/plugins/system/helix3/html/layouts/libraries/cms/html/bootstrap.php';

			if ($this->app->isClient('site') && \file_exists($bootstrapPath))
			{
				if (!class_exists('Helix3Bootstrap'))
				{
					require_once $bootstrapPath;
				}

				JHtml::register('bootstrap.tooltip', ['Helix3Bootstrap', 'tooltip']);
				JHtml::register('bootstrap.popover', ['Helix3Bootstrap', 'popover']);
			}
		}
	}

    // Copied style
    function onAfterDispatch() {

        if(  !JFactory::getApplication()->isClient('administrator') ) {

            $activeMenu = JFactory::getApplication()->getMenu()->getActive();

            if(is_null($activeMenu)) $template_style_id = 0;
            else $template_style_id = (int) $activeMenu->template_style_id;
            if ($template_style_id > 0)
            {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->select(array('*'));
                $query->from($db->quoteName('#__template_styles'));
                $query->where($db->quoteName('client_id') . ' = 0');
                $query->where($db->quoteName('id') . ' = ' . $db->quote($template_style_id));
                $db->setQuery($query);
                $style = $db->loadObject();

                if(!empty($style->template) && !empty($style->params))
                {
                    JFactory::getApplication()->setTemplate($style->template, $style->params);
                }
            }
        }
    }

    function onContentPrepareForm($form, $data)
    {
        $v = self::getVersion();
        $doc = JFactory::getDocument();
        $plg_path = JURI::root(true) . '/plugins/system/helix3';
        $plg_path2 = JURI::root() . 'plugins/system/helix3';
        JForm::addFormPath(JPATH_PLUGINS.'/system/helix3/params');

        if ($form->getName()=='com_menus.item') { //Add Helix menu params to the menu item
            JHtml::_('jquery.framework');
            $data = (array)$data;

            if($data['id'] && $data['parent_id'] == 1)
            {
                $doc->addStyleSheet($plg_path . '/assets/css/bootstrap.css?' . $v);
                $doc->addStyleSheet($plg_path . '/assets/css/font-awesome.min.css?' . $v);
                $doc->addStyleSheet($plg_path . '/assets/css/modal.css?' . $v);
                $doc->addStyleSheet($plg_path . '/assets/css/menu.generator.css?' . $v);
                
                JHtml::_('jquery.framework');

                if(JVERSION < 4)
                {
                    JHtml::_('jquery.ui', array('core', 'more', 'sortable'));
                    $doc->addScript($plg_path.'/assets/js/jquery-ui.draggable.min.js?' . $v);
                }
                else
                {
                    $doc->addScript($plg_path . '/assets/js/jquery-ui.min.js?' . $v);
                }
                $doc->addScript($plg_path . '/assets/js/modal.js?' . $v);
                $doc->addScript($plg_path . '/assets/js/menu.generator.js?' . $v);
                $form->loadFile('menu-parent', false);

            } else {
                $form->loadFile('menu-child', false);
            }

            $form->loadFile('page-title', false);

        }

        //Article Post format
        if ($form->getName() == 'com_content.article') {
            JHtml::_('jquery.framework');
            $doc->addStyleSheet($plg_path.'/assets/css/font-awesome.min.css?' . $v);
            $doc->addScript($plg_path.'/assets/js/post-formats.js?' . $v);

            $tpl_path = JPATH_ROOT . '/templates/' . $this->getTemplateName();

            if(JFile::exists( $tpl_path . '/post-formats.xml' )) {
                JForm::addFormPath($tpl_path);
            } else {
                JForm::addFormPath(JPATH_PLUGINS . '/system/helix3/params');
            }

            $form->loadFile('post-formats', false);
        }

    }


    // Live Update system
    public function onExtensionAfterSave($option, $data) {

        if ($option == 'com_templates.style' && !empty($data->id)) {

            $params = new JRegistry;
            $params->loadString($data->params);

            $email       = $params->get('joomshaper_email');
            $license_key = $params->get('joomshaper_license_key');
            $template = trim($data->template);

            if(!empty($email) and !empty($license_key) )
            {

                $extra_query = 'joomshaper_email=' . urlencode($email);
                $extra_query .='&amp;joomshaper_license_key=' . urlencode($license_key);

                $db = JFactory::getDbo();

                $fields = array(
                    $db->quoteName('extra_query') . '=' . $db->quote($extra_query),
                    $db->quoteName('last_check_timestamp') . '=0'
                );

                $query = $db->getQuery(true)
                    ->update($db->quoteName('#__update_sites'))
                    ->set($fields)
                    ->where($db->quoteName('name').'='.$db->quote($template));
                $db->setQuery($query);
                $db->execute();
            }
        }
    }

    public function onAfterRoute()
    {
        $japps = JFactory::getApplication();

        if ( $japps->isClient('administrator') )
        {
            $user = JFactory::getUser();

            if( !in_array( 8, $user->groups ) ){
                return false;
            }

            $inputs = JFactory::getApplication()->input;

            $option         = $inputs->get ( 'option', '' );
            $id             = $inputs->get ( 'id', '0', 'INT' );
            $helix3task     = $inputs->get ( 'helix3task' ,'' );

            if ( strtolower( $option ) == 'com_templates' && $id && $helix3task == "export" )
            {
               $db = JFactory::getDbo();
               $query = $db->getQuery(true);

               $query
                    ->select( '*' )
                    ->from( $db->quoteName( '#__template_styles' ) )
                    ->where( $db->quoteName( 'id' ) . ' = ' . $db->quote( $id ) . ' AND ' . $db->quoteName( 'client_id' ) . ' = 0' );

                $db->setQuery( $query );

                $result = $db->loadObject();

                header( 'Content-Description: File Transfer' );
                header( 'Content-type: application/txt' );
                header( 'Content-Disposition: attachment; filename="' . $result->template . '_settings_' . date( 'd-m-Y' ) . '.json"' );
                header( 'Content-Transfer-Encoding: binary' );
                header( 'Expires: 0' );
                header( 'Cache-Control: must-revalidate' );
                header( 'Pragma: public' );

                echo $result->params;

                exit;
            }
        }

    }

    private function getTemplateName()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('template')));
        $query->from($db->quoteName('#__template_styles'));
        $query->where($db->quoteName('client_id') . ' = 0');
        $query->where($db->quoteName('home') . ' = 1');
        $db->setQuery($query);

        return $db->loadObject()->template;
    }

    function onAfterRender() {
        $app = JFactory::getApplication();

  		if ($app->isClient('administrator'))
        {
  			return;
  		}
          
        $body = JFactory::getApplication()->getBody();
  		$preset = Helix3::Preset();

  		$body = str_replace('{helix_preset}', $preset, $body);

  		JFactory::getApplication()->setBody($body);
    }

    private static function getVersion()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query
			->select(array('*'))
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('type').' = '.$db->quote('plugin'))
			->where($db->quoteName('element').' = '.$db->quote('helix3'))
			->where($db->quoteName('folder').' = '.$db->quote('system'));
		$db->setQuery($query);
		$result = $db->loadObject();
		$manifest_cache = json_decode($result->manifest_cache);
		
		if (isset($manifest_cache->version))
		{
			return $manifest_cache->version;
		}
		
		return;
	}
}
