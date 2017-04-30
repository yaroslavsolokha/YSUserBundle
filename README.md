YSUserBundle
=======
Inside - FOSuserbundle, SonataAdminBundle, SonataUserBundle, HWIOAuthBundle, Materialize, Bower.

#### Setup
##### 1. Add to your composer:
```
"require": {
    ...
    "ys/user-bundle" : "dev-master",
    "sonata-project/user-bundle": "dev-add_support_for_fos_user2"
    },
"repositories" : [{
    ...
    "type" : "vcs",
    "url" : "https://github.com/yaroslavsolokha/YSUserBundle.git"
}],
```
##### 2. Composer update
##### 3. Parameters.yml
```
parameters:
    database_host: xxx
    database_port: xxx
    database_name: xxx
    database_user: xxx
    database_password: xxx
    mailer_transport: smtp
    mailer_host: xxx
    mailer_user: xxx
    mailer_password: xxx
    secret: xxx
    facebook_client_id: xxx
    facebook_client_secret: xxx
    google_client_id: xxx
    google_client_secret: xxx
```
##### 4. Add to AppKernel.php
```
$bundles = [
    ...
    new FOS\UserBundle\FOSUserBundle(),
    new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
    new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
    // These are the other bundles the SonataAdminBundle relies on
    new Knp\Bundle\MenuBundle\KnpMenuBundle(),
    new Sonata\CoreBundle\SonataCoreBundle(),
    new Sonata\BlockBundle\SonataBlockBundle(),
    // And finally, the storage and SonataAdminBundle
    new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
    new Sonata\AdminBundle\SonataAdminBundle(),
    new Ivory\OrderedFormBundle\IvoryOrderedFormBundle(),
    new YS\UserBundle\YSUserBundle()
];
```
##### 5. Add import to config.yml
```
imports:
    ...
    - { resource: "@YSUserBundle/Resources/config/security.yml" }
    - { resource: "@YSUserBundle/Resources/config/config.yml" }
```
##### 6. Add to routing.yml
```
...
ys_user_bundle:
    resource: "@YSUserBundle/Resources/config/routing.yml"
```

#### TODO
##### 1. sonata-project/user-bundle": "dev-add_support_for_fos_user2 - move to bundle composer