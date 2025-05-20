<?php

namespace OS\Controller;

class GoogleAnalyticsController
{
    private string $privateKey;
    private string $clientEmail;
    private $rawId;

    public function __construct()
    {
        $this->clientEmail = "INSERT YOUT EMAIL";
        $this->rawId = 'INSERT YOUR ACCOUNT';
        $this->privateKey = "INSERT YOUT KEY";

        if (!$this->privateKey) {
            throw new \RuntimeException('GOOGLE_API not set in environment variables');
        }
    }

    public function get_views_by_slug($slug)
    {
        $now = time();
        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        $claims = [
            'iss' => $this->clientEmail,
            'scope' => 'https://www.googleapis.com/auth/analytics.readonly',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600,
            'iat' => $now
        ];

        $base64UrlHeader = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
        $base64UrlClaims = rtrim(strtr(base64_encode(json_encode($claims)), '+/', '-_'), '=');
        $signatureInput = $base64UrlHeader . '.' . $base64UrlClaims;

        openssl_sign($signatureInput, $signature, $this->privateKey, 'sha256WithRSAEncryption');
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        $jwt = $signatureInput . '.' . $base64UrlSignature;
        // Obter token OAuth
        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]));
        $response = json_decode(curl_exec($ch), true);
        $access_token = $response['access_token'] ?? null;

        if (!$access_token) {
            echo "Erro ao obter token: " . json_encode($response);
            exit;
        }
        // Consulta à API do GA4
        
        $property_id = 'properties/' . $this->rawId;

        $body = [
            "dateRanges" => [
                ["startDate" => "2020-01-01", "endDate" => "today"]
            ],
            "dimensions" => [
                ["name" => "pagePath"]
            ],
            "metrics" => [
                ["name" => "screenPageViews"]
            ],
            "dimensionFilter" => [
                "filter" => [
                    "fieldName" => "pagePath",
                    "stringFilter" => [
                        "matchType" => "CONTAINS",
                        "value" => $slug
                    ]
                ]
            ]
        ];

        $ch = curl_init("https://analyticsdata.googleapis.com/v1beta/$property_id:runReport");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($ch);
        $data = json_decode($response, true);

        if (isset($data['error'])) {
            echo 'Erro na consulta: ' . $data['error']['message'];
            exit;
        }

        $views = $data['rows'][0]['metricValues'][0]['value'] ?? 0;

        return $views;
    }
}
