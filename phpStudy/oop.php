
面向对象

我们可以想象我们的宇宙是由不同的对象组成，像太阳，地球，月亮等等。同样我们可以想象我们的车由不同的组件组成如车轮，转向盘，齿轮等。同样有面向对象编程概念，假设一切作为对象使用不同的对象实例化一个事物。

面向对象的概念
在我们进入讲述细节之前，让我们首先定义面向对象编程相关的重要术语。

类：这是一个编程定义的数据类型,包括本地的方法以及本地数据。你能想到的一个类模板制作许多相同类型的实例(或类)的对象。

对象：一个单独的数据结构用来定义的一个类的实例。你定义一个类,然后让许多对象属于它。对象也被称为实例。

成员变量：这是在类的内部定义的变量。这些数据对于外部类是不可见的,但是可以通过成员函数来访问。对象一旦创建这些变量被称该对象的属性。

成员函数：这些函数定义在一个类,用于访问对象的数据。

继承：当一个类被定义为继承一个已经存在的父类，我们称这个类为继承类，这里继承类可以使用父类的一些成员函数和变量。

父类：一个类被另一个类继承。这个类也被称为基类或超类。

子类：一个类继承另一个类。这个类也被称为一个子类或派生类

多态性：这是一个面向对象的概念，相同的函数可以用于不同的目的。例如函数名仍将是相同的，但它采取不同的数量的参数,可以做不同的任务，完成不同的工作。

重载：一种多态性的部分指在所有的运算符有不同的实现取决于他们的类型参数。同样的函数也可以重载伴随着不同的实现。

数据抽象：任何表示的数据的实现细节是隐藏(抽象)。

封装：是指一个概念,我们的所有数据和成员函数封装在一起,形成一个对象

构造函数：指一个特殊的函数类型可以被自动调用，构造函数的类会在每次创建新对象时先调用此方法。

析构函数：指一个特殊的函数类型可以被自动调用，会在到某个对象的所有引用都被删除或者当对象被显式销毁时执行。
定义的 PHP 类
在 PHP 中定义一个新类的一般形式如下：

    <?php
    class phpClass{
       var $var1;
       var $var2 = "constant string";
       function myfunc ($arg1, $arg2) {
          [..]
       }
       [..]
    }
    ?>
这是每一行的描述：

定义类形式 Class，后面是您想要定义的类的名称。
一组花括号包含任意数量的变量声明和函数定义。
变量声明开始使用 var 的特殊形式，紧随其后的是一个传统的 $ 变量名；他们可能也有一个初始化分配一个常量值。
函数定义看起来很像独立的 PHP 函数，但该类和将被用于设置和访问对象数据。
例子

这里是一个例子定义了一个书籍类型类：

    <?php
    class  Books{
        /* Member variables */
        var $price;
        var $title;
        /* Member functions */
        function setPrice($par){
           $this->price = $par;
        }
        function getPrice(){
           echo $this->price ."<br/>";
        }
        function setTitle($par){
           $this->title = $par;
        }
        function getTitle(){
           echo $this->title ." <br/>";
        }
    }
    ?>
变量 $this 是一个特殊的变量，它指的是同一个对象，本身。

用 PHP 创建对象
你一旦定义好你的类，那么您可以创建许多对象。下面是一个例子，如何使用 new 操作符创建对象。

    $physics = new Books;
    $maths = new Books;
    $chemistry = new Books;
在这里，我们已经创建了三个对象，这些对象是相互独立的，他们有自己的单独存在的空间。接下来，我们将看到如何访问成员函数和成员变量的过程。

调用成员函数
创建对象后，您将能够使用相关的对象调用成员函数。一个成员函数将能够处理相关对象的成员变量。

下面的例子显示了如何通过调用成员函数设置标题和价格三本书。

    $physics->setTitle( "Physics for High School" );
    $chemistry->setTitle( "Advanced Chemistry" );
    $maths->setTitle( "Algebra" );

    $physics->setPrice( 10 );
    $chemistry->setPrice( 15 );
    $maths->setPrice( 7 );
现在你调用另一个成员函数获取设置在上面的例子的值：

    $physics->getTitle();
    $chemistry->getTitle();
    $maths->getTitle();
    $physics->getPrice();
    $chemistry->getPrice();
    $maths->getPrice();   
这将会产生以下结果：

    Physics for High School
    Advanced Chemistry
    Algebra
    10
    15
    7
构造函数
构造函数是特殊类型的函数自动创建一个对象时函数的功能会自动执行。所以我们充分利用这个行为，通过构造函数初始化很多功能。PHP 提供了一个特殊的函数叫做 __construct()来定义一个构造函数。你可以把参数传递到构造函数中。以下示例将为书籍类，在创建对象的时候它将创建一个构造函数用来初始化价格和标题这本书。

    function __construct( $par1, $par2 ){
       $this->price = $par1;
       $this->title = $par2;
    }
现在我们不需要调用设置好的函数分别设置价格和标题。我们可以初始化这两个成员变量只在创建对象的时候。检查以下例子：

    $physics = new Books( "Physics for High School", 10 );
    $maths = new Books ( "Advanced Chemistry", 15 );
    $chemistry = new Books ("Algebra", 7 );

    /* Get those set values */
    $physics->getTitle();
    $chemistry->getTitle();
    $maths->getTitle();

    $physics->getPrice();
    $chemistry->getPrice();
    $maths->getPrice();
这将产生以下结果：

    Physics for High School
    Advanced Chemistry
    Algebra
    10
    15
    7
析构函数
您可以定义析构函数：就像定义一个构造函数，析构函数使用函数__destruct()。你可以调用一个析构函数释放所有资源。

继承
PHP 类定义可以使用 extends 关键字继承一个父类。语法如下：

    class Child extends Parent {
     <definition body>
    }
继承的影响是子类 (或派生类或子类)具有以下特点：

自动继承所有父类的成员变量声明。
自动继承父类的成员函数。(默认情况下)像父类一样使用函数。以下例子书类继承和基于需求增加了更多的功能。
    class Novel extends Books{
       var publisher;
       function setPublisher($par){
         $this->publisher = $par;
       }
       function getPublisher(){
         echo $this->publisher. "<br />";
       }
    }
现在除了继承功能，类带了两个额外的成员函数。

函数重载
函数定义子类覆盖与父类中相同的属性及方法名称。在子类中，我们可以修改继承自父类中的方法。

在以下示例中 getPrice 和 getTitle 方法重载。

    function getPrice(){
       echo $this->price . "<br/>";
       return $this->price;
    }
    function getTitle(){
       echo $this->title . "<br/>";
       return $this->title;
    }
公共成员
除非你指定，否则类的属性和方法默认都是公共的。也就是说，他们可能在三种可能的情况下被访问：

从类外声明。
在类中声明。
从另一个类中实现的类声明它。
直到现在我们看到所有成员都作为公共成员。如果你想限制类的成员的可访问性，然后你必须定义类成员为 private 或者 protected。

私有成员
通过指定一个私有成员，你可以限制其访问对象在类外访问它。类的私有成员不能在继承类中调用它，也不能从类外部访问。

私有属性或方法只能在本类内使用：

    class MyClass {
       private $car = "skoda";
       $driver = "SRK";

       function __construct($par) {
          // Statements here run every time
          // an instance of the class
          // is created.
       }
       function myPublicFunction() {
          return("I'm visible!");
       }
       private function myPrivateFunction() {
          return("I'm  not visible outside!");
       }
    }
当 MyClass 类被一个类使用关键字 extends 继承时，myPublicFunction() 方法在子类中是可用的，属性$drive也一样。方法 myPrivateFunction() 和属性 $car 在子类中是不可以被继承的当然也不可以用，因为他们被声明为了私有的。

受保护成员
访问一个受保护的属性或方法并在类中声明它，以及使用关键字 extends 继承该类时。保护成员在两种类型的类之外无法使用。一个类成员可以使用关键字 protected 在其前面。

这是不同版本的 MyClass 类：

    class MyClass {
       protected $car = "skoda";
       $driver = "SRK";

       function __construct($par) {
          // Statements here run every time
          // an instance of the class
          // is created.
       }
       function myPublicFunction() {
          return("I'm visible!");
       }
       protected function myPrivateFunction() {
          return("I'm  visible in child class!");
       }
    }
接口
接口被开发人员定义为提供一个普通的方法名。不同的开发人员可以根据他们不同的需求来分别实现这些接口。你可以说，接口是根据不同的需求被开发人员所实现。

PHP5，可以定义一个接口，如下：

    interface Mail {
       public function sendMail();
    }
然后，另一个类像这样实现该接口：

    class Report implements Mail {
       // sendMail() Definition goes here
    }
常量
一个常量有点像一个变量，它拥有一个值,但实际上更像一个函数，因为常量是永远不变的。一旦你声明一个常量，它不能被改变。

声明一个常量是很容易的，就像下面这个版本的 MyClass，它完成了常量的定义：

    class MyClass {
       const requiredMargin = 1.7;
       function __construct($incomingValue) {
          // Statements here run every time
          // an instance of the class
          // is created.
       }
    }
在这个类中，requiredMargin 是一个常量。它是用关键字 const 声明常量，在任何情况不可以改变他的值 1.7。注意，常量的定义没有 $ 符号，不能像变量那样。

抽象类
抽象类不能被实例化，只能被继承。你用关键字 abstract 声明一个抽象类，就像这样：

当继承一个抽象类的时候，子类必须实现抽象类中的所有的抽象方法，另外，这些方法的可见性必须和抽象类中一样（或更轻松）。

    abstract class MyAbstractClass {
       abstract function myAbstractFunction() {
       }
    }
注意，方法定义在一个抽象类中在方法名称前面之前必须使用关键字 abstract。抽象方法定义在一个非抽象类中是不合法的。

Static关键字
声明类属性或方法为静态，就可以不实例化类而直接访问。静态属性不能通过一个类已实例化的对象来访问（但静态方法可以）。

试运行下面的例子：

    <?php
    class Foo
    {
        public static $my_static = 'foo';

        public function staticValue() {
            return self::$my_static;
        }
    }
    print Foo::$my_static . "\n";
    $foo = new Foo();
    print $foo->staticValue() . "\n";
final 关键字
PHP 5 介绍了这个 final 关键字。如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承。

以下的例子会产生一个致命错误：Cannot override final method BaseClass::moreTesting()。

    <?php
    class BaseClass {
       public function test() {
           echo "BaseClass::test() called<br>";
       }

       final public function moreTesting() {
           echo "BaseClass::moreTesting() called<br>";
       }
    }

    class ChildClass extends BaseClass {
       public function moreTesting() {
           echo "ChildClass::moreTesting() called<br>";
       }
    }
    ?>
调用父类的构造函数
当子类需要一个构造函数时，需要调用父类的构造函数而不是在子类中写一个全新的构造函数，我们需要调用父类的构造函数加一下我们要写的内容，另外在子类的构造函数中做一些初始化是必要的。这是一个简单的例子：

    class Name
    {
       var $_firstName;
       var $_lastName;
       function Name($first_name, $last_name)
       {
         $this->_firstName = $first_name;
         $this->_lastName = $last_name;
       }
       function toString() {
         return($this->_lastName .", " .$this->_firstName);
       }
    }
    class NameSub1 extends Name
    {
       var $_middleInitial;
       function NameSub1($first_name, $middle_initial, $last_name) {
           Name::Name($first_name, $last_name);
           $this->_middleInitial = $middle_initial;
       }
       function toString() {
           return(Name::toString() . " " . $this->_middleInitial);
       }
    }
在上面这个例子中，我们有一个父类(Name)，它里面有一个二个参数的构造函数，在子类中(NameSub1)有一个带有 3 个参数的构造函数。子类 NameSub1 中的构造函数通过调用其父类中的构造函数 Name::Name(传递两个参数)加以使用，然后增加一个额外的属性。同样，NameSub1 定义了 toString() 方法然后重写父类中的 toString() 方法。

注：上例中定义的，可以在子类中定义和父类中相同的构造函数，并且名字名称相同。





类／对象函数库 
call_user_method_array()	调用一个用户方法，同时传递参数数组（已废弃）	4
call_user_method()	对特定对象调用用户方法（已废弃）	4
class_exists()	检查类是否已定义	4
get_class_methods()	返回由类的默认属性组成的数组	4
get_class_vars()	返回对象的参数	4
get_class()	返回由已定义类的名字	4
get_declared_classes()	返回由已定义类的名字所组成的数组	4
get_declared_interfaces()	返回一个数组包含所有已声明的接口	5
get_object_vars()	返回由对象属性组成的关联数组	4
get_parent_class()	返回对象或类的父类名	4
interface_exists()	检查接口是否已被定义	5
is_a()	如果对象属于该类或该类是此对象的父类则返回 TRUE	4
is_subclass_of ()	如果此对象是该类的子类，则返回 TRUE	4
method_exists()	检查类的方法是否存在	4
property_exists()	检查对象或类是否具有该属性	5
