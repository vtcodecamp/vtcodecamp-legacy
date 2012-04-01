class minimal-centos-60 {
  group { "puppet":
    ensure => "present",
  }

  package { "httpd":
    ensure => latest,
  }

  package { "php":
    require => Package["httpd"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php-devel":
    require => Package["php"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php-pecl-apc":
    require => Package["php"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php-pecl-memcache":
    require => Package["php"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php-pear":
    require => Package["php"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php-xml":
    require => Package["php"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "curl":
    ensure => latest,
  }

  file { "/etc/environment":
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/environment",
    notify => Service["httpd"],
  }

  file { "/etc/sysconfig/httpd":
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/sysconfig/httpd",
    notify => Service["httpd"],
  }

  file { "/etc/php.ini":
    require => Package["php"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/php.ini",
    notify => Service["httpd"],
  }

  file { "/etc/php.d/xdebug.ini":
    require => Package["php"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/php.d/xdebug.ini",
    notify => Service["httpd"],
  }

  file { "/etc/httpd/conf/httpd.conf":
    require => Package["httpd"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/httpd/conf/httpd.conf",
    notify => Service["httpd"],
  }

  service { "httpd":
    ensure => running,
    require => [
      Package["httpd"],
      File["/etc/httpd/conf/httpd.conf"],
    ],
  }

  exec {"/usr/bin/pecl upgrade":
    require => Package["php-pear"],
    notify => Service["httpd"],
  }

  exec { "/usr/bin/pecl upgrade pecl.php.net/xdebug":
    require => Exec["/usr/bin/pecl upgrade"],
    notify => Service["httpd"],
  }

  exec {"/usr/bin/pear upgrade":
    require => Package["php-pear"]
  }

  exec { "/usr/bin/pear config-set auto_discover 1":
    require => [
      Package["php-pear"],
      Exec["/usr/bin/pear upgrade"]
    ]
  }

  exec { "/usr/bin/pear upgrade pear.phing.info/phing":
    require => [
      Exec["/usr/bin/pear upgrade"],
      Exec["/usr/bin/pear config-set auto_discover 1"]
    ]
  }

  exec { "/usr/bin/phing -f /vagrant/build.xml build":
    require => [
      Exec["/usr/bin/pear upgrade pear.phing.info/phing"],
    ]
  }
}

include minimal-centos-60
