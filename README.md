# Code Climate PHP Copy Paste Detector

`codeclimate-phpcpd` is a Code Climate Engine that wraps the PHP CPD utility.

### Installation

1. If you haven't already, [install the Code Climate CLI](https://github.com/codeclimate/codeclimate).
2. Run `codeclimate engines:enable phpcpd`. This command both installs the engine and enables it in your `.codeclimate.yml` file.
3. You're ready to analyze! Browse into your project's folder and run `codeclimate analyze`.

### Config Options

-   lines  default 5 Minimum number of identical lines
-   tokens default 70 Minimum number of identical tokens
-   fuzzy default false Fuzz variable names

### Sample Config

    engines:
      phpcpd:
        enabled: true
        recursive: false

    exclude_paths:
      - .git/
      - vendor/

### Need help?

For help with PHP CPD, [check out their repository](https://github.com/sebastianbergmann/phpcpd).
