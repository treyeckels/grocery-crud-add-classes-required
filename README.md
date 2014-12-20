## An extension to the popular CodeIgniter library Grocery Crud that allows you to add class name to fields and automatically adds required attribute and class names

### The following fields types are affected by this extension:
1. string
2. integer
3. true_false
4. text
5. datetime
6. password
7. date
8. dropdown
9. enum
10. set
11. multiselect
12. relation
13. relation_n_n

### Getting started:
1. Add the the extension file to your application -> libraries folder. 
2. Load the main crud library and the extension and instantiate the extension class. See below. Remember to instantiate the extension class and not the original grocery crud class.

```
$this->load->library('grocery_CRUD');
$this->load->library('extension_grocery_CRUD');
$this->crud = new Extension_grocery_CRUD();
```

### Features
#### Required attr and class
This extensions adds the HTML5 required attribute as well as a required class name to any fields that are added to the grocery_CRUD->required_fields element.

#### Add class names to fields
It also adds a public method classes so that you can add class names to your field. It is nondestructive, so any class names already there by the grocer crud framework are preserved and added to the list of classnames. 

Usage example:
```
$this->load->library('grocery_CRUD');
$this->load->library('extension_grocery_CRUD');
$this->crud = new Extension_grocery_CRUD();
$this->crud->classes('field_name', 'class1 class2 class3');
```
