# Password Strength Requirements for Woocommerce

Tags: woocommerce, password strength, security
Requires at least: 5.0
Tested up to: 6.6.1
Stable tag: 1.1.0
Requires PHP: 7.0
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Short Description

A plugin to customise password strength requirements in WooCommerce.

## Description

The **Password Strength for Woocommerce** plugin allows you to customise the password strength requirements in WooCommerce. You can set rules for minimum password length, numeric characters, and special characters to ensure stronger and more secure passwords for your users.

## Features

- **Minimum Password Length**: Choose from predefined options (6, 8, 10, 12, 14, 18, 20, 30 characters).
- **Minimum Numeric Characters**: Specify the number of numeric characters required (None, At least 1, At least 2).
- **Minimum Special Characters**: Specify the number of special characters required (None, At least 1, At least 2).
- **Admin Settings**: Configure settings under WooCommerce > Settings > Accounts & Privacy.

## Installation

1. **Upload Plugin**:
   - Download the plugin zip file.
   - Go to your WordPress admin dashboard.
   - Navigate to `Plugins` > `Add New`.
   - Click `Upload Plugin`, then choose the zip file and click `Install Now`.
   - Activate the plugin.

2. **Configure Settings**:
   - Go to `WooCommerce` > `Settings`.
   - Navigate to the `Accounts & Privacy` tab.
   - Find the `Password Strength Settings` section to configure the password requirements.

## Configuration

- **Minimum Password Length**: Select from dropdown options (6, 8, 10, 12, 14, 18, 20, 30).
- **Minimum Numeric Characters**: Choose the number of numeric characters required.
- **Minimum Special Characters**: Choose the number of special characters required.

## Screenshots

1. **Settings Page**: Options for changing settings in **Woocommerce Settings > 'Accounts & Privacy'.**
   ![Settings Page](assets/images/screenshot-1.png)

## FAQ

**Q: How do I access the plugin settings?**  
A: Go to `WooCommerce` > `Settings` > `Accounts & Privacy` to find and adjust the password strength settings.

**Q: Can I use custom values for password length?**  
A: Currently, the plugin uses predefined dropdown options for password length. Custom values are not supported.

**Q: What happens if I set a password length below the minimum value?**  
A: The plugin automatically enforces a minimum password length of 6 characters.

**Q: What is a suitable setting?**
A: You should select the highest settings you can use for your situation. Settings that are suitable for you depend on many factors, often  balancing accessibility and security. Using 2FA (2 factor authentification) makes a less secure password more acceptable. 

## Changelog

### 1.2.0
- Added dropdown options for minimum password length.
- Updated settings location to WooCommerce > Accounts & Privacy.

## Support

For support, please contact us at [support@bizstudio.co.nz](mailto:support@bizstudio.co.nz).

## License

This plugin is licensed under the [GPL-2.0+](http://www.gnu.org/licenses/gpl-2.0.txt).
