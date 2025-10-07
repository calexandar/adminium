<p align="center">
		<a href="https://serversideup.net/open-source/docker-php/"><img src="https://raw.githubusercontent.com/calexandar/adminium/main/header.png" width="1280" alt="Docker Images Logo"></a>
</p>
<p align="center">
	<a href="https://github.com/serversideup/docker-php/actions/workflows/action_publish-images-production.yml"><img alt="Build Status" src="https://img.shields.io/github/actions/workflow/status/serversideup/docker-php/.github%2Fworkflows%2Faction_publish-images-production.yml"></a>
	<a href="https://github.com/serversideup/docker-php/blob/main/LICENSE" target="_blank"><img src="https://badgen.net/github/license/serversideup/docker-php" alt="License"></a>
	<a href="https://github.com/sponsors/serversideup"><img src="https://badgen.net/badge/icon/Support%20Us?label=GitHub%20Sponsors&color=orange" alt="Support us"></a>
  <br />
  <a href="https://hub.docker.com/r/serversideup/php/"><img alt="Docker Hub Pulls" src="https://img.shields.io/docker/pulls/serversideup/php"></a>
  <a href="https://serversideup.net/discord"><img alt="Discord" src="https://img.shields.io/discord/910287105714954251?color=blueviolet"></a>
</p>

## Introduction
`Adminium` is an optimized set of Docker Images for running PHP applications in production. Everything is designed around improving the developer experience with PHP and Docker. Gone are the days of configuring each environment differently, and gone are the days of trying to figure out why your code works in one environment and not the other.

These images are highly optimized to run modern PHP applications, no matter where you want your application to run.

Experience the ***true difference*** of using these images vs the other options out there.

[Read more about the key differences with these images →](https://serversideup.net/open-source/docker-php/docs/getting-started/these-images-vs-others)

<details open>
<summary>
 Features
</summary> <br />

|<picture><img width="100%" alt="Production-Ready" src="https://serversideup.net/wp-content/uploads/2023/08/production-ready.png"></picture>|<picture><img width="100%" alt="Native Health Checks" src="https://serversideup.net/wp-content/uploads/2023/08/native-health-checks.png"></picture>|<picture><img width="100%" alt="High Performance" src="https://serversideup.net/wp-content/uploads/2023/11/high-performance.png"></picture>|
|:---:|:---:|:---:|
|<picture><img width="100%" alt="Customizable and Flexible" src="https://serversideup.net/wp-content/uploads/2023/08/customizable-flexible.png"></picture>|<picture><img width="100%" alt="Native CloudFlare Support" src="https://serversideup.net/wp-content/uploads/2023/11/cloudflare.png"></picture>|<picture><img width="100%" alt="Base on Official PHP" src="https://serversideup.net/wp-content/uploads/2023/11/official-php.png"></picture>|
|<picture><img width="100%" alt="NGINX Unit" src="https://serversideup.net/wp-content/uploads/2023/11/nginx-unit.png"></picture>|<picture><img width="100%" alt="Unified Logging" src="https://serversideup.net/wp-content/uploads/2023/11/unified-logging.png"></picture>|<picture><img width="100%" alt="FPM + S6 Overlay" src="https://serversideup.net/wp-content/uploads/2023/11/fpm-s6.png"></picture>|

</details>

## Professionally Supported
Are you looking for help on integreating Docker with your PHP application? We have multiple options to help your team out:

- [Get Managed Hosting](https://serversideup.net/hire-us/): CI/CD design and engineering, managed hosting, guaranteed uptime, any host, any server.
- [Get Professional Help](https://schedule.serversideup.net/team/serversideup/quick-chat-with-jay): Get video + screen-sharing help directly from the core contributors.
- [Get a Full-Stack Development Team](https://serversideup.net/hire-us/): We can build your app from the ground up, or help you with your existing codebase.

## Usage
This repository creates a number of Docker image variations, allowing you to choose exactly what you need.

Simply use this image name pattern in any of your projects:
```sh
serversideup/php:{{version}}-{{variation-name}}
```
For example... If I wanted to run **PHP 8.2** with **FPM + NGINX**, I would use this image:
```sh
serversideup/php:8.2-fpm-nginx
```

> [!NOTE]  
> All our images are available on [**Docker Hub**](https://hub.docker.com/r/serversideup/php/) and [**GitHub Packages**](https://github.com/serversideup/docker-php/pkgs/container/php). 🥳


## Resources
- **[Website](https://alex-web.mk/showcase/adminium/)** overview of the product.
- **[Docs](https://serversideup.net/open-source/docker-php/docs)** for a deep-dive on how to use the product.
- **[Discord](https://serversideup.net/discord)** for friendly support from the community and the team.
- **[GitHub](https://github.com/calexandar/adminium)** for source code, bug reports, and project management.
- **[Get Professional Help](https://alex-web.mk/contact)** - Get video + screen-sharing help directly from the core contributors.

## Contributing
As an open-source project, we strive for transparency and collaboration in our development process. We greatly appreciate any contributions members of our community can provide. Whether you're fixing bugs, proposing features, improving documentation, or spreading awareness - your involvement strengthens the project. Please review our [contribution guidelines](https://serversideup.net/open-source/docker-php/docs/getting-started/contributing) and [code of conduct](./.github/code_of_conduct.md) to understand how we work together respectfully.

- **Bug Report**: If you're experiencing an issue while using these images, please [create an issue](https://github.com/serversideup/docker-php/issues/new/choose).
- **Feature Request**: Make this project better by [submitting a feature request](https://github.com/serversideup/docker-php/discussions/66).
- **Documentation**: Improve our documentation by [submitting a documentation change](./docs/README.md).
- **Community Support**: Help others on [GitHub Discussions](https://github.com/serversideup/docker-php/discussions) or [Discord](https://serversideup.net/discord).
- **Security Report**: Report critical security issues via [our responsible disclosure policy](https://www.notion.so/Responsible-Disclosure-Policy-421a6a3be1714d388ebbadba7eebbdc8).

Need help getting started? Join our Discord community and we'll help you out!

<a href="https://serversideup.net/discord"><img src="https://serversideup.net/wp-content/themes/serversideup/images/open-source/join-discord.svg" title="Join Discord"></a>

## Our Sponsors
All of our software is free an open to the world. None of this can be brought to you without the financial backing of our sponsors.

<p align="center"><a href="https://github.com/sponsors/serversideup"><img src="https://521public.s3.amazonaws.com/serversideup/sponsors/sponsor-box.png" alt="Sponsors"></a></p>

### Black Level Sponsors
<a href="https://sevalla.com"><img src="https://serversideup.net/wp-content/uploads/2024/10/sponsor-image.png" alt="Sevalla" width="546px"></a>

#### Bronze Sponsors
<!-- bronze -->No bronze sponsors yet. <a href="https://github.com/sponsors/serversideup">Become a sponsor →</a><!-- bronze -->

#### Special Infrastructure Sponsors
This project takes an incredible amount of computing power to build and maintain over 8,000 different docker image tags. We're extremely grateful for the following sponsors who help bring the power to ship more PHP.

<a href="https://depot.dev/"><img src="https://serversideup.net/sponsors/depot.png" alt="Depot" width="250px"></a>&nbsp;&nbsp;<a href="https://hub.docker.com/u/serversideup"><img src="https://serversideup.net/sponsors/docker.png" alt="Docker" width="250px"></a>

#### Individual Supporters
<!-- supporters --><a href="https://github.com/GeekDougle"><img src="https://github.com/GeekDougle.png" width="40px" alt="GeekDougle" /></a>&nbsp;&nbsp;<a href="https://github.com/MaltMethodDev"><img src="https://github.com/MaltMethodDev.png" width="40px" alt="MaltMethodDev" /></a>&nbsp;&nbsp;<a href="https://github.com/bananabrann"><img src="https://github.com/bananabrann.png" width="40px" alt="bananabrann" /></a>&nbsp;&nbsp;<!-- supporters -->

#### Special thanks
We'd like to specifically thank a few folks for taking the time for being a sound board that deeply influenced the direction of this project.

Please check out their work:
- [Chris Fidao](https://x.com/fideloper)
- [Joel Clermont](https://x.com/jclermont)
- [Patricio](https://x.com/PatricioOnCode)

## About Me
I am [Aleksandar](https://x.com/AlexDeveloperMk). I created [Adminium](https://alex-web.mk/adminium) to help share what I have learnt.

<div align="center">

| <div align="center">Aleksandar Cvetanovski</div>                  |                                 |
| ----------------------------- | ------------------------------------------ |
| <div align="center"><a href="https://x.com/AlexDeveloperMk"><img src="https://alex-web.mk/assets/image/removed_bg.webp" title="Dan Pastori" width="150px"></a><br /><a href="https://x.com/AlexDeveloperMk"><img src="https://serversideup.net/wp-content/themes/serversideup/images/open-source/twitter.svg" title="Twitter" width="24px"></a><a href="https://github.com/calexandar"><img src="https://serversideup.net/wp-content/themes/serversideup/images/open-source/github.svg" title="GitHub" width="24px"></a></div>                        |                                        |

</div>

### Find me at:

* **📖 [Blog](https://alex-web.mk/articles)** - Get the latest guides and free courses on all things in web development.
* **🙋 [Community](https://community.serversideup.net)** - Get friendly help from our community members.
* **🤵‍♂️ [Get Professional Help](https://alex-web.mk/contact)** - Get video + screen-sharing support from me.
* **💻 [GitHub](https://github.com/calexandar)** - Check out our other open source projects.
* **📫 [Newsletter](https://alex-web.mk/#newsletterForm)** - Skip the algorithms and get quality content right to your inbox.
* **🐥 [Twitter](https://x.com/AlexDeveloperMk)** - You can also follow me [AlexDeveloperMk](https://x.com/AlexDeveloperMk).
* **❤️ [Sponsor Us](https://github.com/sponsors/serversideup)** - Please consider sponsoring us so we can create more helpful resources.

## My products
If you appreciate this project, be sure to check out our other projects.

### 📚 Books
- **[The Ultimate Guide to Building APIs & SPAs](https://serversideup.net/ultimate-guide-to-building-apis-and-spas-with-laravel-and-nuxt3/)**: Build web & mobile apps from the same codebase.
- **[Building Multi-Platform Browser Extensions](https://serversideup.net/building-multi-platform-browser-extensions/)**: Ship extensions to all browsers from the same codebase.

### 🛠️ Software-as-a-Service
- **[Cakulet](https://cakulet.com/)**: Get visual bug reports directly in GitHub, GitLab, and more.
- **[SelfHost Pro](https://selfhostpro.com/)**: Connect Stripe or Lemonsqueezy to a private docker registry for self-hosted apps.

### 🌍 Open Source
- **[AmplitudeJS](https://521dimensions.com/open-source/amplitudejs)**: Open-source HTML5 & JavaScript Web Audio Library.
- **[Spin](https://serversideup.net/open-source/spin/)**: Laravel Sail alternative for running Docker from development → production.
- **[Financial Freedom](https://github.com/serversideup/financial-freedom)**: Open source alternative to Mint, YNAB, & Monarch Money.