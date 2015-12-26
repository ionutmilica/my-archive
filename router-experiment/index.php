<?php

require 'Route.php';


function simulate_uri($uri)
{
	foreach (Route::all() as $route)
	{
		$route->compile();

		if ($route->matches($uri))
		{
			//var_dump($route->getData());
			call_user_func_array($route->getCallback(), $route->getData());
		}
	}
}


/* Tests */

Route::add('site/test', 'SiteController::contactAction');

Route::add('{controller}/{action}/{id?}', function ($controller, $action, $id) 
{ 

	echo $controller, ' ', $action, ' ', $id;

})->where('action', 'user');

Route::add('{controller}/{action}/{id}', function ($controller, $action, $id) 
{
	echo sprintf('Te saluta %s::%s(%s) ^_^', $controller, $action, $id);
})
->where('id', '[0-9]+');

Route::add('{lang}/{controller}/{action?}', function ($lang, $controller, $action = null) 
{

});


simulate_uri('user/settings/1005321');

