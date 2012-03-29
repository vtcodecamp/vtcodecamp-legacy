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

  file { "/etc/php.ini":
    require => Package["php"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/php.ini",
    notify => Service["httpd"],
  }

  file { "/etc/httpd/conf/httpd.conf":
    require => Package["httpd"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/httpd.conf",
    notify => Service["httpd"],
  }

  service { "httpd":
    ensure => running,
    require => [
      Package["httpd"],
      File["/etc/httpd/conf/httpd.conf"],
    ],
  }
}

include minimal-centos-60
