<?php
/**
 * Note : Code is released under the GNU LGPL
 *
 * Please do not change the header of this file 
 *
 * This library is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * Lesser General Public License as published by the Free Software Foundation; either version 2 of 
 * the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 *
 * See the GNU Lesser General Public License for more details.
 */

/**
 * File:        CoreController.php
 * 
 * @author      Anis BEREJEB
 * @version     0.1
 */

/**
 * Represents the core controller
 * 
 */
class CoreController implements IController
{
	/**
	 * The core view object 
	 *
	 * @var mainview
	 */
	public $view = null;
	
	/**
	 * the view name 
	 * 
	 * @var string  Defaults to null. 
	 */
	private $_viewName = null;
	
	/**
	 * the request
	 * 
	 * @var array
	 */
	public $request;
	
	/**
	 * the controller name
	 * 
	 * @var string  Defaults to null. 
	 */
	private $_controllerName = null;

	/**
	 * The action name
	 * 
	 * @var string  Defaults to null. 
	 */
	private $_actionName = null;

    /**
     * array of the used variables. must be overriden
     * by child if need to access models
     *
     * @var array
     */
	protected $_useModels = array();
	
	/**
     * always function, to be executed every time
     *
     */
	public function alwaysAction()
	{
		$dispatcher = frontDispatcher::getInstance();
		$this->view->setMessage(
		Toolbox::getArrayParameter($dispatcher->getParams(),'message',''),
		Toolbox::getArrayParameter($dispatcher->getParams(),'messageType','success')
		);
	}

    /**
     * Inject dependencies of the Controller
     * 
     * @param  Container  $container The Container
     */
    public function setContainer(Container $container)
    {
        $this->Router = $container['Router'];
        $this->Dispatcher = $container['Dispatcher'];
        $this->CacheManager = $container['CacheManager'];
    } 

	/**
	 * Action name Setter
	 * 
	 * @param  string  $actionName The name of the action
	 */
	public function setActionName($actionName)
	{
		$this->_actionName = $actionName;
	}

	/**
	 * Action name Getter
	 * 
	 * @return string The action name
	 */
	public function getActionName()
	{
		return $this->_actionName;
	}

    /**
     * Returns the used models 
     * 
     * @return array of used models
     */
    public function getUsedModels()
    {
        return $this->_useModels;
    }    
    
    /**
     * Sets a model to the controller
     * 
     * @param  CoreModel  $model The model
     */
    public function setModel(CoreModel $model)
    {
        $this->{$model->getModelName()} = $model;
    }

    /**
     * Sets a view to the controller
     * 
     * @param  CoreView  $view The view to be set
     */
    public function setView(CoreView $view)
    {
        $this->view = $view;
    }    
}
