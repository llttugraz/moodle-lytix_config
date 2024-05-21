# lytix\_config

This plugin is a subplugin of [local_lytix](https://github.com/llttugraz/moodle-local_lytix).  
The `lytix_config` plugin allows configuration of the main module, enabling it to work in combination with various sub-modules across different Moodle instances.

## Installation

1. Download the plugin and extract the files.
2. Move the extracted folder to your `moodle/local/lytix/modules` directory.
3. Log in as an admin in Moodle and navigate to `Site Administration > Plugins > Install plugins`.
4. Follow the on-screen instructions to complete the installation.

## Requirements

- Moodle Version: 4.1+
- PHP Version: 7.4+
- Supported Databases: MariaDB, PostgreSQL
- Supported Moodle Themes: Boost

## Features

- `lytix_config` uses a specific template for different platforms to ensure seamless integration with the sub-modules.
- The template for the Creators Dashboard is not availabe for the public because of dependecies to 3d party plugins.
- Based on the chosen dashboard version in the admin settings, the appropriate Mustache template is loaded.

## Dependencies

- [local_lytix](https://github.com/llttugraz/moodle-local_lytix).
- [lytix_config](https://github.com/llttugraz/moodle-lytix_config).
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs).

## License

This plugin is licensed under the [GNU GPL v3](https://github.com/llttugraz/moodle-lytix_config?tab=GPL-3.0-1-ov-file).

## Contributors

- **Günther Moser** - Developer - [GitHub](https://github.com/ghinta)
- **Alex Kremser** - Developer
