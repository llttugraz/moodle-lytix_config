# lytix_config

#### Overview
The `lytix_config` plugin allows configuration of the main module, enabling it to work in combination with various sub-modules across different Moodle instances.

#### Features

##### Subplugin Integration
- `lytix_config` uses a specific template for different platforms to ensure seamless integration with the sub-modules.
- Based on the chosen dashboard version in the admin settings, the appropriate Mustache template is loaded.

##### Error Checking
- If the required sub-plugins are not installed, the user will receive an error message when trying to open a course's dashboard.

#### Requirements
- The main module and relevant sub-modules should be correctly installed and configured.
- Regularly checking for updates for the plugin and associated sub-modules is recommended to avoid compatibility issues.

#### Installation and Configuration
1. Download the plugin and install it on your Moodle instance.
2. Navigate to the admin settings and select the desired dashboard version.
3. Verify the integration with the sub-modules and update them if necessary.
