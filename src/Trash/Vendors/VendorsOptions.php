<?php


use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;

/**
 * VendorsOptions
 *
 * @ORM\Table(name="vendors_options", uniqueConstraints={@ORM\UniqueConstraint(name="slug", columns={"slug"})})
 * @ORM\Entity
 */
class VendorsOptions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vendor_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vendorId;

    /**
     * @var TextType
     *
     * @ORM\Column(name="vendor_store_desc", type="text", nullable=false)
     */
    private $vendorStoreDesc;

    /**
     * @var TextType
     *
     * @ORM\Column(name="vendor_terms_of_service", type="text", nullable=false)
     */
    private $vendorTermsOfService;

    /**
     * @var TextType
     *
     * @ORM\Column(name="vendor_legal_info", type="text", nullable=false)
     */
    private $vendorLegalInfo;

    /**
     * @var TextType
     *
     * @ORM\Column(name="vendor_letter_css", type="text", nullable=false)
     */
    private $vendorLetterCss;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_letter_header_html", type="string", nullable=false, options={"default"="'<h1>{vm:vendorname}</h1><p>{vm:vendoraddress}</p>'"})
     */
    private $vendorLetterHeaderHtml = '\'<h1>{vm:vendorname}</h1><p>{vm:vendoraddress}</p>\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_letter_footer_html", type="string", nullable=false, options={"default"="'<p>{vm:vendorlegalinfo}<br />Page {vm:pagenum}/{vm:pagecount}</p>'"})
     */
    private $vendorLetterFooterHtml = '\'<p>{vm:vendorlegalinfo}<br />Page {vm:pagenum}/{vm:pagecount}</p>\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_store_name", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorStoreName = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_phone", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorPhone = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_url", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorUrl = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_desc", type="string", nullable=false, options={"default"="''"})
     */
    private $metaDesc = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", nullable=false, options={"default"="''"})
     */
    private $metaKey = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_title", type="string", nullable=false, options={"default"="''"})
     */
    private $customTitle = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_invoice_free1", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorInvoiceFree1 = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_invoice_free2", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorInvoiceFree2 = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_mail_free1", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorMailFree1 = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_mail_free2", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorMailFree2 = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_mail_css", type="string", nullable=false, options={"default"="''"})
     */
    private $vendorMailCss = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", nullable=false, options={"default"="''"})
     */
    private $slug = '\'\'';


}
