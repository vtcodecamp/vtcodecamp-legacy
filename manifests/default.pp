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

  service { "httpd":
    ensure => running,
    require => Package["httpd"]
  }
}

include minimal-centos-60
