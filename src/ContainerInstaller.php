<?php

namespace Larabeans\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class ContainerInstaller
 *
 * @author  Ali Kamzi <ali@kazmi.me>
 */
class ContainerInstaller extends LibraryInstaller
{
	/**
	 * {@inheritDoc}
	 */
	public function getInstallPath(PackageInterface $package)
	{
		$containerName = $package->getPrettyName();
		$extras = json_decode(json_encode($package->getExtra()));
		if (isset($extras->apiato->container->name)) {
			$containerName = $extras->apiato->container->name;
		}

        $containerSection = 'Vendor';
        if (isset($extras->apiato->container->section)) {
            $containerSection = $extras->apiato->container->section;
        }
		return "app/Containers/" . $containerSection . "/" . $containerName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return ('larabeans-container' === $packageType);
	}
}
