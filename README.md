# lytix\_config

This plugin is a subplugin of [local_lytix](https://github.com/llttugraz/moodle-local_lytix).
The `lytix_config` plugin allows configuration of the main module, enabling it to work in combination with various sub-modules across different Moodle instances.

## Table of Contents

- [Installation](#installation)
- [Requirements](#requirements)
- [Features](#features)
- [Configuration](#configuration)
- [Usage](#usage)
- [Dependencies](#dependencies)
- [API Documentation](#api-documentation)
- [Subplugins](#subplugins)
- [Privacy](#privacy)
- [FAQ](#faq)
- [Known Issues](#known-issues)
- [Changelog](#changelog)
- [License](#license)
- [Contributors](#contributors)

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

## Configuration

Describe here how to configure the plugin after installation, including available settings and how to adjust them.

## Usage

Explain how to use the plugin with step-by-step instructions and provide screenshots if they help clarify the process.

## Dependencies

- [local_lytix](https://github.com/llttugraz/moodle-local_lytix).
- [lytix_config](https://github.com/llttugraz/moodle-lytix_config).
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs).

## API Documentation

If your plugin offers API endpoints, document what they return and how to use them here.

## Subplugins

If there are any subplugins, provide links and descriptions for each.

## Privacy

Detail what personal data the plugin stores and how it handles this data.

## FAQ

**Q:** Frequently asked question here?
**A:** Answer to the question here.

**Q:** Another frequently asked question?
**A:** Answer to the question here.

## Known Issues

- Issue 1: Solution or workaround for the issue.
- Issue 2: Solution or workaround for the issue.

## License

This plugin is licensed under the [GNU GPL v3](https://github.com/llttugraz/moodle-lytix_config?tab=GPL-3.0-1-ov-file).

## Contributors

- **Günther Moser** - Developer - [GitHub](https://github.com/ghinta)
- **Alex Kremser** - Developer - [GitHub](https://github.com/llt-tuggy)

