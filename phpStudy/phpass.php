<?php
// Include phpass 库
require_once('phpass-03/PasswordHash.php')

// 初始化散列器为不可移植(这样更安全)
$hasher = new PasswordHash(8, false);

// 计算密码的哈希值。$hashedPassword 是一个长度为 60 个字符的字符串.
$hashedPassword = $hasher->HashPassword('my super cool password');

// 你现在可以安全地将 $hashedPassword 保存到数据库中!

// 通过比较用户输入内容（产生的哈希值）和我们之前计算出的哈希值，来判断用户是否输入了正确的密码
$hasher->CheckPassword('the wrong password', $hashedPassword);  // false

$hasher->CheckPassword('my super cool password', $hashedPassword);  // true
?>
/**
陷阱
许多资源可能推荐你在哈希之前对你的密码“加盐”。想法很好，但 phpass 在 HashPassword() 函数中已经对你的密码“加盐”了，这意味着你不需要自己“加盐”。

**/