<?php

namespace App\Helpers;

class Dijkstra
{
    private $vertices;
    private $graph;

    public function __construct($vertices)
    {
        $this->vertices = $vertices;
        $this->graph = array_fill(0, $vertices, array_fill(0, $vertices, 0));
    }

    public function addEdge($start, $end, $weight)
    {
        $this->graph[$start][$end] = $weight;
        $this->graph[$end][$start] = $weight; // For undirected graph
    }

    public function dijkstra($source)
    {
        $distances = array_fill(0, $this->vertices, PHP_INT_MAX);
        $visited = array_fill(0, $this->vertices, false);

        $distances[$source] = 0;

        for ($i = 0; $i < $this->vertices - 1; $i++) {
            $u = $this->minDistance($distances, $visited);
            $visited[$u] = true;

            for ($v = 0; $v < $this->vertices; $v++) {
                if (!$visited[$v] && $this->graph[$u][$v] != 0 && $distances[$u] != PHP_INT_MAX
                    && $distances[$u] + $this->graph[$u][$v] < $distances[$v]) {
                    $distances[$v] = $distances[$u] + $this->graph[$u][$v];
                }
            }
        }

        return $distances;
    }

    private function minDistance($distances, $visited)
    {
        $min = PHP_INT_MAX;
        $minIndex = -1;

        for ($v = 0; $v < $this->vertices; $v++) {
            if (!$visited[$v] && $distances[$v] <= $min) {
                $min = $distances[$v];
                $minIndex = $v;
            }
        }

        return $minIndex;
    }
}
