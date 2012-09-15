<?php
namespace meme\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
                
        if(!array_key_exists('active', $options)) {
            $options['active'] = '';
        }
        
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav'));
        
        $items = array(
            'Newest jokes'      => 'homepage', 
            'Top jokes'         => 'top',
            'Random joke'       => 'random',
            'Submit your own'   => 'submit',
            'About'             => 'about',
        );

        foreach($items as $item => $route) {
            $menu->addChild($item, array('route' => $route));
            if($route === $options['active']) {
                $menu[$item]->setAttributes(array('class' => 'active'));
            }
        }

        return $menu;
    }
}