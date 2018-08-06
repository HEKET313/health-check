# Health Check Bundle

This bundle adds `/health` endpoints and `health:send-info` command to project.

For using this bundle you have to add configuration files:

* `config/routes/niklesh_health.yaml` (required)

```yaml
health_check:
  resource: "@HealthCheckBundle/Controller/HealthController.php"
  prefix: /
  type: annotation
```

* `config/packages/hiklesh_health.yaml` (optional)

```yaml
health_check:
  senders:
    - 'App\Service\Sender'
```