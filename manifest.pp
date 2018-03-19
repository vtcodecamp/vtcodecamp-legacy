class minimal-centos-60 {
  group { "puppet":
    ensure => "present",
  }

  package { "epel-release":
    provider => rpm,
    ensure => installed,
    source => "http://dl.iuscommunity.org/pub/ius/stable/Redhat/6/x86_64/epel-release-6-5.noarch.rpm"
  }

  package { "ius-release":
    require => Package["epel-release"],
    provider => rpm,
    ensure => installed,
    source => "http://dl.iuscommunity.org/pub/ius/stable/Redhat/6/x86_64/ius-release-1.0-15.ius.el6.noarch.rpm"
  }

  exec { "upgrade-ca-certificates":
    command => "/usr/bin/yum upgrade ca-certificates -y --disablerepo=epel",
    require => Package["ius-release"],
  }

  package { "httpd":
    ensure => latest,
  }

  package { "php56u":
    require => [
      Package["httpd"],
      Exec["upgrade-ca-certificates"]
    ],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php56u-devel":
    require => Package["php56u"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php56u-pecl-apcu":
    require => Package["php56u"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php56u-pear":
    require => Package["php56u"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "php56u-xml":
    require => Package["php56u"],
    ensure => latest,
    notify => Service["httpd"],
  }

  package { "curl":
    ensure => latest,
  }

  package { "git":
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
    require => Package["php56u"],
    ensure => file,
    owner => root,
    group => root,
    mode => 0644,
    source => "/vagrant/etc/php.ini",
    notify => Service["httpd"],
  }

  file { "/etc/php.d/xdebug.ini":
    require => Package["php56u"],
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

  exec { "/usr/bin/pecl upgrade":
    require => Package["php56u-pear"],
    notify => Service["httpd"],
    timeout => 0,
  }

  exec { "/usr/bin/pecl upgrade pecl.php.net/xdebug":
    require => Exec["/usr/bin/pecl upgrade"],
    notify => Service["httpd"],
    timeout => 0,
  }

  exec { "/usr/bin/pear upgrade":
    require => Package["php56u-pear"],
    timeout => 0,
  }

  exec { "/usr/bin/pear config-set auto_discover 1":
    require => [
      Package["php56u-pear"],
      Exec["/usr/bin/pear upgrade"]
    ],
    timeout => 0,
  }

  exec { "/usr/bin/pear upgrade pear.phing.info/phing":
    require => [
      Exec["/usr/bin/pear upgrade"],
      Exec["/usr/bin/pear config-set auto_discover 1"]
    ],
    timeout => 0,
  }

  exec { "/usr/bin/phing -f /vagrant/build.xml build":
    logoutput => on_failure,
    timeout => 0,
  }

  exec { "/usr/bin/php /vagrant/admin.php events:build":
    require => Exec["/usr/bin/phing -f /vagrant/build.xml build"],
    environment => [
      "DATA_CACHE=/tmp/data",
    ],
    logoutput => on_failure,
    timeout => 0,
  }
}

include minimal-centos-60
