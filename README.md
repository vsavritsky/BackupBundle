# VsavritskyBackupBundle

This bundle allows creating and managing backups in a Symfony application. It is a wrapper for
[vsavritsky/backup](https://github.com/kbond/php-backup).

## Installation

Require this bundle with composer:

    composer require vsavritsky/backup-bundle

Then enable it in your kernel:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Vsavritsky\BackupBundle\VsavritskyBackupBundle(),
        //...
    );
}
```

## Configuration

In your `config.yml` add at least one source, namer, processor, and destination as well as a profile.

Example:

```yaml
vsavritsky_backup:
    sources:
        database:
            mysqldump:
                database: my_database
        files:
            rsync:
                source: "%kernel.root_dir%/../web/files"
                additional_options:
                    - --exclude=_cache/
    namers:
        daily:
            timestamp:
                format: d
                prefix: mysite-
        snapshot:
            timestamp:
                prefix: mysite-
    processors:
        zip: { zip: ~ }
    destinations:
        s3:
            s3cmd:
                bucket: "s3://foobar/backups"
    profiles:
        daily:
            scratch_dir: "%kernel.root_dir%/cache/backup"
            sources: [database, files]
            namer: daily
            processor: zip
            destinations: [s3]
```

## Commands

### Run Backup Command

```
Usage:
 vsavritsky:backup:run [--clear] [<profile>]

Arguments:
 profile  The backup profile to run (leave blank for listing)

Options:
 --clear  Set this flag to clear scratch directory before backup
```

**NOTES**:

1. Add `-vv` to see the log.
2. For long running backups, it may be required to increase the `memory_limit` in your `app/console`/`bin/console`.
3. Running the command without a profile will list available profiles.

Examples (with the above configuration):

* Create a backup at: `s3://foobar/backups/mysite-{day-of-month}`

        bin/console vsavritsky:backup:run daily

* Create a backup at: `s3://foobar/backups/mysite-{YYYYMMDDHHMMSS}`

        bin/console vsavritsky:backup:run snapshot

### List Existing Backups

```
Usage:
  Vsavritsky:backup:list [<profile>]

Arguments:
  profile  The backup profile to list backups for (leave blank for listing)
```

**NOTE**: Running the command without a profile will list available profiles.

## Full Default Config

```yaml
vsavritsky_backup:
    namers:

        # Prototype
        name:
            simple:
                name:                 backup
            timestamp:
                format:               YmdHis
                prefix:               ''
                timezone:             ~
    processors:

        # Prototype
        name:
            zip:
                options:              '-r'
                timeout:              300
            gzip:
                options:              '-czvf'
                timeout:              300
    sources:

        # Prototype
        name:
            mysqldump:
                database:             ~ # Required
                host:                 ~
                user:                 root
                password:             null
                ssh_host:             null
                ssh_user:             null
                ssh_port:             22
                timeout:              300
            rsync:
                source:               ~ # Required
                timeout:              300
                additional_options:   []
                default_options:

                    # Defaults:
                    - -acrv
                    - --force
                    - --delete
                    - --progress
                    - --delete-excluded
    destinations:

        # Prototype
        name:
            stream:
                directory:            ~ # Required
            flysystem:
                filesystem_service:   ~ # Required
            s3cmd:
                bucket:               ~ # Required, Example: s3://foobar/backups
                timeout:              300
    profiles:

        # Prototype
        name:
            scratch_dir:          '%kernel.cache_dir%/backup'
            sources:              [] # Required, can be a string
            namer:                ~  # Required
            processor:            ~  # Required
            destinations:         [] # Required, can be a string
```
