# Code Climate PHP Copy Paste Detector

`codeclimate-phpcpd` is a Code Climate Engine that wraps the PHP CPD utility.

### Installation

1. If you haven't already, [install the Code Climate CLI](https://github.com/codeclimate/codeclimate).
2. Run `codeclimate engines:enable phpcpd`. This command both installs the engine and enables it in your `.codeclimate.yml` file.
3. You're ready to analyze! Browse into your project's folder and run `codeclimate analyze`.

### Config Options

- recursive - default false, Report code as dead if it is only called by dead code

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
