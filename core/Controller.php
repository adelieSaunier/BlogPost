<?php
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use Twig\TwigFunction;

class Controller
{
    public function view(string $path, $datas = []){
        $loader = new FilesystemLoader('../ressources/views');
        $twig = new Environment($loader, [
            'cache' => false, // pour ne pas enregistrer le cache en developpement
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension);
        $twig->addFunction(new TwigFunction('route', function($name, $params =[]){
            return routename($name, $params);
        }));
        $twig->addFunction(new TwigFunction('flash', function($name = '', $message = '', $class = 'message-success'){
            return flash($name, $message, $class);
        }));
        
        $twig->addGlobal('auth', auth());
        $twig->addGlobal('post', recordedposts());
        echo $twig->render($path . '.twig', $datas);
    }
}