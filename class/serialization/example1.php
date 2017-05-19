<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/8
 * Time: 22:10
 */
/**
 *  所有php里面的值都可以使用函数serialize()来返回一个包含字节流的字符串来表示。
 * unserialize()函数能够重新把字符串变回php原来的值。
 * 序列化一个对象将会保存对象的所有变量，但是不会保存对象的方法，只会保存类的名字。
 * 为了能够unserialize()一个对象，这个对象的类必须已经定义过。
 * 如果序列化类A的一个对象，将会返回一个跟类A相关，而且包含了对象所有变量值的字符串。
 * 如果要想在另外一个文件中解序列化一个对象，这个对象的类必须在解序列化之前定义，
 * 可以通过包含一个定义该类的文件或使用函数spl_autoload_register()来实现。
 *
 * 简单来说，你要使用序列化的后的类，之前要有此类的声明。
 */
require_once 'A.php';
$a = new A();
$s = serialize($a);
// 把变量$s保存起来以便文件page2.php能够读到
file_put_contents('store', $s);
