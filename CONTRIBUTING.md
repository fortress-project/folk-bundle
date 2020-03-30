# Contributing guidelines

## Git flow

We're using git flow conventions as described in
[the blog post](https://nvie.com/posts/a-successful-git-branching-model/) that founded Git Flow.

### Branch naming conventions

The issue number (`{issue-num}`) must be used as name (without `#`).

Current branch naming conventions are:

* `feature/{issue-num}` for new features that have been requested.
* `bugfix/{issue-num}` for bug fixes (every code style corrections, documentation correction, etc. are also bug fixes).
* `hotfix/{issue-num}` for high priority bug fixes.
* `release/{issue-num}` for release preparation.

Note: the standard branches `develop` and `master` are protected.

* `master` is used for latest release tracking.
* `develop` is used for latest development version tracking.

## Issues

First of all please check if your issue doesn't exists already on the tracker using the search tool.

Then follow the provided template.

### Feature requests

Please make sure the requested feature is inside the scope of this project.

## Pull requests

Please follow the provided template and make sure your code follows the [Code of conduct](#code-of-conduct)

## Code of conduct

Our code of conduct is based on GitHub Contributor Covenant Code of Conduct template.
 [You can read it here.](CODE_OF_CONDUCT.md)

## Code style

We try to keep an open code style so here's the few mandatory things.

### Indentation

Make use of the **tab** character where possible (*Note: the YAML format do not allow tabs so this is the only allowed
 case to not use tabs*).

This is because most IDEs allow to configure the tab length. Recommended tab length is 4 spaces.

### Single quotes and double quotes

PHP language allows double quotes to evaluate PHP variables. We decided to discourage use of those quotes to enhance
 performance.

So please avoid using **double quotes** when not necessary.

### Braces placement

Every opening braces must be placed on the line following the declaration.

This is asked for an easier code readability.
