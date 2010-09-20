<?php

# Collectd LibVirt plugin

# Details on http://github.com/octo/collectd/blob/master/src/libvirt.c



require_once 'conf/common.inc.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# disk_ops-X.rrd
# if_dropped-XX.rrd
# if_errors-XX.rrd
# if_octets-XX.rrd
#if_packets-XX.rrd
# virt_cpu_total.rrd

require_once 'type/Default.class.php';
$obj = new Type_Default($CONFIG);

switch($_GET['t']) {
# disk_ops
	case 'disk_ops':
        $obj->data_sources = array('read', 'write');
        $obj->ds_names = array(
            'read' => 'Read',
            'write' => 'Written',
        );
		$obj->rrd_title = 'Disk Operations';
		$obj->rrd_vertical = '';
	break;

# virt_cpu_total 
	case 'virt_cpu_total':
        $obj->data_sources = array('ns');
		$obj->ds_names = array(
			'ns' => 'CPU total ',
		);
		$obj->rrd_title = 'VCPU Usage';
		$obj->rrd_vertical = '';
	break;

# if_dropped / if_errors / if_octets / if_packets
    default:
        $obj->data_sources = array('rx', 'tx');
		$obj->ds_names = array(
			'rx'   => 'Receive',
			'tx'   => 'Transmit',
		);
		$obj->rrd_title = $_GET['t'];
		$obj->rrd_vertical = '';
	break;
}

$obj->generate_colors();

$obj->width = $width;
$obj->heigth = $heigth;
$obj->rrd_format = '%5.1lf%s';

collectd_flush($obj->identifiers);
$obj->rrd_graph();

?>
