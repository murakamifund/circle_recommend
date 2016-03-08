<url>
	<loc><?php echo $this->Html->url(Array('controller' => 'Students', 'action' => 'home'), true); ?></loc>
	<priority>1.0</priority>
	<changefreq>always</changefreq>
</url>
<url>
	<loc><?php echo $this->Html->url(Array('controller' => 'Students', 'action' => 'student'), true); ?></loc>
	<priority>1.0</priority>
	<changefreq>always</changefreq>
</url>

<?php foreach ($circles as $d): ?>
    <url>
        <loc><?php echo $this->Html->url(Array('controller' => 'Students', 'action' => 'circle_id', h($d['Circle']['id'])), true); ?></loc>
        <priority>1.0</priority>
        <changefreq>always</changefreq>
    </url>
    <?php foreach ($events as $e): ?>
    <?php if($e['Event']['circle_id'] == $d['Circle']['id']): ?>
    	<url>
        	<loc><?php echo $this->Html->url(Array('controller' => 'Students', 'action' => 'event_id', h($e['Event']['id'])), true); ?></loc>
        	<priority>1.0</priority>
        	<changefreq>always</changefreq>
    	</url>
    <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<url>
	<loc><?php echo $this->Html->url(Array('controller' => 'Students', 'action' => 'circle'), true); ?></loc>
	<priority>1.0</priority>
	<changefreq>always</changefreq>
</url>
