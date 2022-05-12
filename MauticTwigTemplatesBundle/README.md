# Twig Templates for Mautic 4, Mautic 3 and Mautic 2

This plugin works on Mautic 4. Download link for Mautic 3 version is included in the package in `mautic3-version.md` file.
Download link for Mautic 2 version is included in the package in `mautic2-version.md` file.

Download link for Mautic 2 is included in the package in file mautic2-version.md.

Twig templates for Mautic. Define unlimited Twig Templates and add it to email or sms by token `{twigtemplate=1}`

## Support

https://mtcextendee.com

## Installation

### Manual 
- Download last version
- Unzip files to plugins/MauticTwigTemplatesBundle
- Clear cache (app/cache/prod/)
- Go to /s/plugins/reload
- Enable TwigTemplates plugin 

## Usage

1, See new item on left menu Twig Templates:

<img src="https://user-images.githubusercontent.com/462477/75027424-da2a6980-549e-11ea-857b-f03c862bd7f2.png" alt="" width="500">

2, Setup Twig Templates

3, You can use Twig syntax

Example:

```twig
{% if contact.firstname %}
<p>Hi {{ contact.firstname }},</p>
{% elseif  contact.lastname %}
<p>Hi {{ contact.lastname}},</p>
{% endif %} 
```

<img src="https://user-images.githubusercontent.com/462477/75027549-047c2700-549f-11ea-9d7c-91d76d4dcbd9.png" alt="" width="500">

4. You can test by test area bellow the edit form

<img src="https://user-images.githubusercontent.com/462477/75027678-4311e180-549f-11ea-88e1-2843354bcf6a.png" alt="500" />

5. Then go to emails and use token in email builder or subject. Tokens also works with suggestion (press `{` and search)

`{twigtemplate=1}`

## Aditional features

#### Contact's tags

`{{ contact.tags }}`

Allow use contact's tags in twig syntax. You can use Twig filter and parse data what do you want.

```
 [tags] => Array
        (
            [2] => Another tag,
            [32] => Test tag
        )
```

#### Contact's segments

`{{ contact.segments }}`


Allow use contact's segments with twig syntax.  You can use Twig filter and parse data what do you want.

```
    [segments] => Array
        (
            [13] => Array
                (
                    [isPublished] => 1
                    [dateAdded] => DateTime Object
                        (
                            [date] => 2020-02-17 14:27:35.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [createdBy] => 1
                    [createdByUser] => Admin1 User
                    [dateModified] => DateTime Object
                        (
                            [date] => 2020-02-17 14:28:15.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                    [modifiedBy] => 1
                    [modifiedByUser] => Admin1 User
                    [checkedOut] =>
                    [checkedOutBy] =>
                    [checkedOutByUser] => Admin1 User
                    [id] => 13
                    [name] => Twig test
                    [description] =>
                    [alias] => twig-test
                    [filters] => Array
                        (
                            [0] => Array
                                (
                                    [object] => lead
                                    [glue] => and
                                    [field] => firstname
                                    [type] => text
                                    [filter] => Test1
                                    [display] =>
                                    [operator] => =
                                )

                            [1] => Array
                                (
                                    [glue] => or
                                    [field] => firstname
                                    [object] => lead
                                    [type] => text
                                    [filter] => Test2
                                    [display] =>
                                    [operator] => =
                                )

                        )

                    [isGlobal] => 1
                    [isPreferenceCenter] =>
                )
        )
)
```

#### JSON decode

Twig template support JSON decode. 

Example:

```twig
{% set cart = contact.json_field | json_decode %}
{% for item in cart %}
{{item.name | raw }}
{% endfor %} (edited) 
```
#### API support

Twig templates support standard API operation GET/POST/PUT/PATCH/DELETE.

