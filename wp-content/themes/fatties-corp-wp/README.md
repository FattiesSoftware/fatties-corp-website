# Fatties Corporation WordPress Theme

A modern, vibrant WordPress theme for Fatties Corporation landing page with stunning animations and premium design.

## Features

- **One-page landing page design** with smooth scrolling
- **Animated sections** using AOS (Animate On Scroll)
- **Custom Post Types** for Projects and Team Members
- **Dynamic statistics** with CountUp.js animations
- **Responsive design** that works on all devices
- **Custom meta boxes** for easy content management
- **WordPress Customizer integration** for easy customization
- **Premium aesthetics** with gradient effects and hover animations

## Installation

1. **Upload the theme:**
   - Copy the entire `fatties-corp-wp` folder to `/wp-content/themes/` in your WordPress installation
   - Or zip the folder and upload it via WordPress Admin → Appearance → Themes → Add New → Upload Theme

2. **Activate the theme:**
   - Go to WordPress Admin → Appearance → Themes
   - Find "Fatties Corporation" and click "Activate"

3. **Set up your homepage:**
   - Go to Settings → Reading
   - Set "Your homepage displays" to "A static page"
   - Create a new page called "Home" and select it as the homepage

## Required Images

Place the following images in the `assets/images/` folder:

- `cbh.jpeg` - School background image
- `mission.jpg` - Mission section image
- `vision.jpg` - Vision section image
- `hero-bg.jpg` - Hero section background (optional, can be set via Customizer)

## Adding Content

### Adding Team Members

1. Go to WordPress Admin → Team Members → Add New
2. Enter the team member's name as the title
3. Add their bio in the content editor
4. Set a featured image (their photo - recommended size: 250x250px)
5. Fill in the Team Member Details:
   - Position (e.g., "Chủ tịch HĐQT/Nhà sáng lập")
   - Facebook URL
   - Twitter URL
   - Instagram URL
   - Email
6. Publish

### Adding Projects

1. Go to WordPress Admin → Projects → Add New
2. Enter the project name as the title
3. Add project description in the content editor
4. Set a featured image (project screenshot - recommended size: 350x230px)
5. Fill in the Project Details:
   - Project URL (link to the live project)
   - Project Type (e.g., "Website mạng xã hội")
6. Assign a Project Category (Web, App, Graphic Design)
7. Publish

### Customizing Statistics

1. Go to WordPress Admin → Appearance → Customize
2. Find "Statistics Section"
3. Update the numbers:
   - Projects Completed
   - Happy Customers
   - Child Companies
   - Monthly Visitors
4. Click "Publish" to save

### Customizing Hero Background

1. Go to WordPress Admin → Appearance → Customize
2. Find "Hero Section"
3. Upload a hero background image
4. Click "Publish" to save

## Theme Structure

```
fatties-corp-wp/
├── assets/
│   ├── css/          (for additional stylesheets)
│   ├── js/
│   │   └── main.js   (theme JavaScript)
│   └── images/       (theme images)
├── footer.php        (footer template)
├── functions.php     (theme functions)
├── header.php        (header template)
├── index.php         (main landing page template)
├── single-project.php          (single project template)
├── single-team_member.php      (single team member template)
├── style.css         (main stylesheet)
└── README.md         (this file)
```

## Customization

### Colors

The primary brand color is `#f10992` (pink/magenta). To change it, search and replace in `style.css`:
- `#f10992` - Primary brand color
- `rgba(241, 9, 146, 1)` - Primary brand color (rgba format)

### Fonts

The theme uses Google Fonts "Quicksand". To change the font:
1. Edit `functions.php`
2. Find the `wp_enqueue_style('fatties-corp-fonts'...` line
3. Replace the Google Fonts URL with your preferred font

### Sections

All sections are in `index.php`. You can:
- Reorder sections by moving the HTML blocks
- Hide sections by commenting them out
- Add new sections following the existing structure

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Dependencies

The theme automatically loads these external libraries:
- jQuery (included with WordPress)
- AOS (Animate On Scroll) v2.3.1
- Ionicons v5.5.2
- CountUp.js
- Google Fonts (Quicksand)

## Support

For support, please contact Fatties Corporation at:
- Website: https://fatties.vn
- Email: support@fatties.vn

## License

This theme is licensed under the GNU General Public License v2 or later.

## Credits

- Designed and developed by Fatties Corporation
- Inspired by modern web design trends
- Built with WordPress best practices

## Changelog

### Version 1.0.0
- Initial release
- One-page landing page design
- Custom post types for Projects and Team Members
- Animated sections with AOS
- CountUp statistics
- Responsive design
- WordPress Customizer integration
