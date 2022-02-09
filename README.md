# PHP CodeStyler

![the dragon code php code styler](https://preview.dragon-code.pro/the-dragon-code/php-code-styler.svg?brand=github&invert=1)

[![Stable Version][badge_stable]][link_repo]
[![Unstable Version][badge_unstable]][link_repo]
[![License][badge_license]][link_license]

## Usage

Create a new `.github/workflows/lint.yml` file and add the content to it:

```yaml
name: Code Style

on: [ push, pull_request ]

jobs:
    build:
        runs-on: ubuntu-latest

        steps:
            -   name: Checkout code
                uses: actions/checkout@v2

            -   name: Checking PHP Syntax
                uses: TheDragonCode/php-codestyler@latest
```

That's all. Now, when pushing and pull-requesting, a linter will be triggered, indicating possible errors.

## Configuration

By default, the linter scans the `src` and `tests` folders, but you can override them.

```yaml
-   uses: TheDragonCode/php-codestyler@v1
    with:
        path: 'foo bar baz'
```

or

```yaml
-   uses: TheDragonCode/php-codestyler@v1
    with:
        path: '.'
```

Also, by default, the linter only checks for compliance without making changes to the files.

If you want to apply changes, then use the following example:

```yaml
-   name: Git setup
    run: |
        git config --local user.email "action@github.com"
        git config --local user.name "GitHub Action"

-   uses: TheDragonCode/php-codestyler@latest
    with:
        path: 'src tests'
        fix: true

-   name: Commit changes
    id: commit
    if: success()
    run: |
        IS_DIRTY=1

        { git add . && git commit -a -m "Codestyle fix"; } || IS_DIRTY=0

        echo ::set-output name=is_dirty::${IS_DIRTY}

-   name: Push changes
    uses: ad-m/github-push-action@master
    if: success() && steps.commit.outputs.is_dirty == 1
    with:
        github_token: ${{ secrets.GITHUB_TOKEN }}
```

## License

This package is licensed under the [MIT License](LICENSE).


[badge_license]:    https://img.shields.io/badge/license-MIT-green?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/TheDragonCode/php-codestyler?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:     LICENSE

[link_repo]:        https://github.com/TheDragonCode/php-codestyler
