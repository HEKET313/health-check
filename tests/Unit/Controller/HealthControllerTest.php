<?php

namespace Optimax\HealthCheckBundle\Tests\Unit\Controller;

use Optimax\HealthCheckBundle\Controller\HealthController;
use Optimax\HealthCheckBundle\Entity\CommonHealthData;
use Optimax\HealthCheckBundle\Entity\HealthDataInterface;
use Optimax\HealthCheckBundle\Service\HealthInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthControllerTest extends TestCase
{
    private const RESULT_HEALTH = [
        [
            'name' => 'HealthService1',
            'info' => [
                'status' => HealthDataInterface::STATUS_OK,
                'additional_info' => []
            ]
        ],
        [
            'name' => 'HealthService2',
            'info' => [
                'status' => HealthDataInterface::STATUS_CRITICAL,
                'additional_info' => [
                    'some_field_1' => 'info_1',
                    'some_field_2' => 'info_2'
                ]
            ]
        ],
        [
            'name' => 'HealthService3',
            'info' => [
                'status' => HealthDataInterface::STATUS_WARNING,
                'additional_info' => [
                    'inner_array' => [
                        'inner_array_key' => 'inner_value'
                    ],
                    'inner_field' => 'some_value_3'
                ]
            ]
        ]
    ];

    public function testGetHealth()
    {
        $controller = new HealthController();
        $container = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->setMethods(['has'])
            ->getMock();
        $container->method('has')->willReturn(false);
        $controller->setContainer($container);
        $controller->addHealthService($this->getHealthService('HealthService1', HealthDataInterface::STATUS_OK, []));
        $controller->addHealthService($this->getHealthService('HealthService2', HealthDataInterface::STATUS_CRITICAL, [
            'some_field_1' => 'info_1',
            'some_field_2' => 'info_2'
        ]));
        $controller->addHealthService($this->getHealthService('HealthService3', HealthDataInterface::STATUS_WARNING, [
            'inner_array' => [
                'inner_array_key' => 'inner_value'
            ],
            'inner_field' => 'some_value_3'
        ]));

        $response = $controller->getHealth();
        $this->assertEquals(json_encode(self::RESULT_HEALTH), $response->getContent());
    }

    /**
     * @param string $name
     * @param int $status
     * @param array $additionalInfo
     * @return HealthInterface
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function getHealthService(string $name, int $status, array $additionalInfo)
    {
        return new class($name, $status, $additionalInfo) implements HealthInterface
        {
            private $name;
            private $info;

            public function __construct(string $name, int $status, array $additionalInfo)
            {
                $this->name = $name;
                $this->info = new CommonHealthData($status);
                $this->info->setAdditionalInfo($additionalInfo);
            }

            public function getName(): string
            {
                return $this->name;
            }

            public function getHealthInfo(): HealthDataInterface
            {
                return $this->info;
            }
        };
    }
}
