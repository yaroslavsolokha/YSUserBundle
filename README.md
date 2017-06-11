YSUserBundle
=======
Documentation for internal settings for bundle
Inside - FOSuserbundle, SonataAdminBundle, SonataUserBundle, HWIOAuthBundle, Materialize, Bower.

#### Setup
##### 1. Add to your composer:
```
"require": {
    ...
    "ys/user-bundle" : "dev-master",
    "sonata-project/user-bundle": "dev-add_support_for_fos_user2"
    },
"repositories" : [
...
{
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
##### 4. Add translator to config.yml
```
framework:
    translator: { fallbacks: ['%locale%'] }
```
##### 5. Add to AppKernel.php
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
##### 6. Add import to config.yml
```
imports:
    ...
    - { resource: "@YSUserBundle/Resources/config/config.yml" }
```
##### 7. Add to security.yml
```
# To get started with security, check out the documentation:
# http://symfony.com/doc/current/security.html
security:

    encoders:
        Symfony\Component\Security\Core\User\User: plaintext
        FOS\UserBundle\Model\UserInterface: sha512

    role_hierarchy:
        ROLE_SONATA_ADMIN: ROLE_USER
        ROLE_ADMIN: ROLE_SONATA_ADMIN
        ROLE_SUPER_ADMIN: ROLE_ADMIN

    providers:
        fos_userbundle:
            id: fos_user.user_provider.username

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            pattern: ^/
            form_login:
                provider: fos_userbundle
                login_path: /login
                check_path: /login_check
            oauth:
                resource_owners:
                    facebook: "/login/check-facebook"
                    gplus: "/login/check-google"
                login_path:  /login
                oauth_user_provider:
                    service: ys.user.provider
            logout:       true
            anonymous:    true

    access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: ROLE_ADMIN }
```
##### 8. Add to routing.yml
```
...
ys_user_bundle:
    resource: "@YSUserBundle/Resources/config/routing.yml"
```
##### 9. Update schema
```
$ bin/console doctrine:schema:update
```
##### 10. bin/console assets:install
##### 11. bin/console fos:user:create admin --super-admin
##### 12. Go:
###### - XXX/app_dev.php/login
###### - XXX/app_dev.php/admin
###### - XXX/app_dev.php/register
###### - XXX/app_dev.php/resetting/request
###### - XXX/app_dev.php/profile
###### - XXX/app_dev.php/profile/edit
##### 13. Extend Bundle layout for index page, replace app/Resources/views/default/index.html.twig to:
```
{% extends 'YSUserBundle::base.html.twig' %}
{% block body %}
    <div class="main container">
        <h1>YSUserBundle</h1>
        <ul>
            <li><a href="{{ path('sonata_admin_dashboard') }}">Admin</a></li>
            <li><a href="{{ path('fos_user_security_login') }}">Sign In</a></li>
            <li><a href="{{ path('fos_user_registration_register') }}">Sign Up</a></li>
            <li><a href="{{ path('fos_user_resetting_request') }}">Forgot password?</a></li>
            <li><a href="{{ path('fos_user_profile_show') }}">Show profile</a></li>
            <li><a href="{{ path('fos_user_profile_edit') }}">Edit profile</a></li>
            <li><a href="{{ path('fos_user_security_logout') }}">Sign Out</a></li>
        </ul>
    </div>
{% endblock %}
```
#### TODO
##### 1. sonata-project/user-bundle": "dev-add_support_for_fos_user2 - move to bundle composer