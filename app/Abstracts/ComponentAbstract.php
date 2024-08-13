<?php

namespace Realtyna\Core\Abstracts;

/**
 * Class ComponentAbstract
 *
 * A base class for components in the Realtyna plugin.
 * This class handles the registration of subcomponents, admin pages, and custom post types.
 */
abstract class ComponentAbstract
{
    /**
     * @var array List of subcomponent class names.
     */
    protected array $subComponents = [];

    /**
     * @var array List of custom post type class names.
     */
    protected array $postTypes = [];

    /**
     * ComponentAbstract constructor.
     *
     * Initializes the component by calling methods to define and register post types,
     * subcomponents, and admin pages.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->postTypes();
        $this->subComponents();
        $this->registerPostTypes();
        $this->registerSubComponents();
        $this->register();
    }

    /**
     * Registers the component, including any additional functionality that needs to be
     * implemented by the subclass.
     *
     * @return void
     */
    abstract public function register(): void;

    /**
     * Defines the custom post types that the component should register.
     * This method must be implemented by the subclass.
     *
     * @return void
     */
    abstract public function postTypes(): void;

    /**
     * Defines the subcomponents that the component should register.
     * This method must be implemented by the subclass.
     *
     * @return void
     */
    abstract public function subComponents(): void;

    /**
     * Adds a custom post type to the component.
     *
     * @param string $postType The class name of the post type to add.
     * @return void
     */
    public function addPostType(string $postType): void
    {
        $this->postTypes[] = $postType;
    }

    /**
     * Registers all custom post types associated with the component.
     *
     * @return void
     */
    private function registerPostTypes(): void
    {
        foreach ($this->postTypes as $postType) {
            $service = new $postType();
            add_action('after_setup_theme', [$service, 'register']);
        }
    }

    /**
     * Adds a subcomponent to the component.
     *
     * @param string $subComponent The class name of the subcomponent to add.
     * @return void
     */
    public function addSubComponent(string $subComponent): void
    {
        $this->subComponents[] = $subComponent;
    }

    /**
     * Registers all subcomponents associated with the component.
     *
     * @return void
     * @throws \ReflectionException
     */
    private function registerSubComponents(): void
    {
        foreach ($this->subComponents as $subComponent) {
            $service = new $subComponent();
            if ($service instanceof ComponentAbstract && method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}
